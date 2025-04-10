<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    /**
     * Constructor untuk menerapkan middleware
     */
    public function __construct()
    {
        // Middleware untuk memastikan user sudah terverifikasi emailnya
        $this->middleware('verified_email')->only(['dashboard']);
        // Middleware untuk admin role
        $this->middleware('admin')->only(['adminDashboard']);
        // Middleware untuk user role
        $this->middleware('user')->only(['userDashboard']);
    }

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('pages.login'); // Pastikan ada file resources/views/pages/login.blade.php
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function register()
    {
        return view('pages.register'); // Pastikan ada file resources/views/pages/register.blade.php
    }

    /**
     * Menampilkan dashboard admin
     */
    public function adminDashboard()
    {
        return view('pages.admin.dashboard');
    }

    /**
     * Menampilkan dashboard user
     */
    public function userDashboard()
    {
        return view('pages.user.dashboard');
    }

    /**
     * Proses autentikasi user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            // Check if the email is verified
            if (!Auth::user()->email_verified_at) {
                // Log out the user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Redirect to the verification notice page
                return redirect('/email/verify')->with('error', 'Email belum diverifikasi. Silakan verifikasi email Anda terlebih dahulu.');
            }
            
            $request->session()->regenerate();
            
            // Check if user is admin to redirect to admin dashboard
            if (Auth::user()->is_admin) {
                return redirect()->intended('/adminDashboard');
            }
            
            return redirect()->intended('/dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses registrasi user baru
     */
    public function store(Request $request)
    {
        // Validasi input sesuai database
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomer_hp' => 'required|regex:/^[0-9]+$/|min:10|max:15|unique:users,nomer_hp',
            'password' => 'required|min:6|max:10|confirmed'
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'nomer_hp.unique' => 'Nomor HP harus angka dan belum terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 10 karakter.'
        ]);

        // Hash password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_admin'] = 0; // Default user biasa

        try {
            // Generate verification code
            $code = rand(1000, 9999);
            $validatedData['verification_code'] = $code;
            $validatedData['verification_code_expires_at'] = now()->addMinutes(30); // Perpanjang waktu kadaluarsa menjadi 30 menit
            
            // Simpan user ke database
            $user = User::create($validatedData);
            
            // Send verification email
            Mail::to($user->email)->send(new EmailVerificationMail($code));
            
            // Login user for verification process
            Auth::login($user);
            
            // Redirect to verification page
            return redirect()->route('email.verify.code')
                ->with('success', 'Akun berhasil dibuat! Silakan verifikasi email Anda.');
                
        } catch (Exception $e) {
            Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    /**
     * Verifikasi email dengan kode
     */
    public function verifyEmailForm()
    {
        if (Auth::check() && Auth::user()->email_verified_at) {
            return redirect()->route('user.dashboard')->with('info', 'Email Anda sudah terverifikasi');
        }
        
        return view('pages.verify-email');
    }

    /**
     * Proses verifikasi email dengan kode
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric|digits:4'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah kode verifikasi benar dan belum kadaluarsa
        if ($user->verification_code == $request->verification_code && 
            now()->lt($user->verification_code_expires_at)) {
            
            // Update user sebagai terverifikasi
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->verification_code_expires_at = null;
            $user->save();

            return redirect()->route('user.dashboard')
                ->with('success', 'Email berhasil diverifikasi! Selamat datang di dashboard.');
        }

        return back()->with('error', 'Kode verifikasi salah atau sudah kadaluarsa');
    }

    /**
     * Kirim ulang kode verifikasi
     */
    public function resendVerificationCode()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if ($user->email_verified_at) {
            return redirect()->route('user.dashboard')->with('info', 'Email Anda sudah terverifikasi');
        }

        // Generate kode baru
        $code = rand(1000, 9999);
        $user->verification_code = $code;
        $user->verification_code_expires_at = now()->addMinutes(30);
        $user->save();

        // Kirim email verifikasi
        Mail::to($user->email)->send(new EmailVerificationMail($code));

        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda');
    }

    /**
     * Logout user dan hapus sesi
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }

    /**
     * Mendapatkan user yang sedang login
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Redirect ke Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Log the Google user information for debugging
            Log::info('Google user retrieved', [
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName()
            ]);

            // First check if user exists with the same Google ID
            $findUser = User::where('google_id', $googleUser->getId())->first();

            // Then check if user exists with same email
            $userWithSameEmail = User::where('email', $googleUser->getEmail())->first();

            if ($findUser) {
                // User found by google_id, login
                Log::info('Found user by google_id', ['user_id' => $findUser->id]);
                Auth::login($findUser);
                
                // Set email as verified jika belum
                if (!$findUser->email_verified_at) {
                    $findUser->email_verified_at = now();
                    $findUser->save();
                }
                
                return $findUser->is_admin ? 
                    redirect()->route('admin.dashboard')->with('success', 'Login berhasil dengan Google!') :
                    redirect()->route('user.dashboard')->with('success', 'Login berhasil dengan Google!');
            } elseif ($userWithSameEmail) {
                // User with same email exists, update their google_id and login
                Log::info('Found user by email, updating google_id', ['user_id' => $userWithSameEmail->id]);
                $userWithSameEmail->update([
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => $userWithSameEmail->email_verified_at ?? now()
                ]);

                Auth::login($userWithSameEmail);
                
                return $userWithSameEmail->is_admin ? 
                    redirect()->route('admin.dashboard')->with('success', 'Login berhasil dengan Google!') :
                    redirect()->route('user.dashboard')->with('success', 'Login berhasil dengan Google!');
            } else {
                // Create a new user with Google account data
                Log::info('Creating new user with Google account');

                // Explicitly create with all required fields
                $newUser = User::create([
                    'nama' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'sekolah' => 'Belum diisi',
                    'nomer_hp' => 'Belum diisi',
                    'password' => Hash::make(Str::random(16)),
                    'is_admin' => 0,
                    'email_verified_at' => now() // Set email as verified karena dari Google OAuth
                ]);

                Log::info('New user created', ['user_id' => $newUser->id]);

                // Login the new user
                Auth::login($newUser);

                // Redirect to profile page to complete missing info
                return redirect()->route('profile.edit')->with('info', 'Akun berhasil dibuat dengan Google. Silakan lengkapi profil Anda.');
            }
        } catch (Exception $e) {
            // Get the SQL statement if it's a query exception
            $sqlStatement = ($e instanceof \Illuminate\Database\QueryException)
                ? $e->getSql()
                : 'Not an SQL error';

            // Detailed error logging
            Log::error('Google login error', [
                'error' => $e->getMessage(),
                'sql' => $sqlStatement,
                'trace' => $e->getTraceAsString(),
                'previous' => $e->getPrevious() ? $e->getPrevious()->getMessage() : null
            ]);

            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi atau hubungi administrator.');
        }
    }
}