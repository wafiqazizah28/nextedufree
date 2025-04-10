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
     * Proses autentikasi user
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation attack

            // Tentukan redirect berdasarkan peran user
            $redirectLink = Auth::user()->is_admin ? '/adminDashboard' : '/admminDashboard';

            return redirect()->intended($redirectLink)->with('success', 'Login berhasil as ' . Auth::user()->nama);
        }

        return back()->with('error', 'Login failed, please check your credentials');
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
            $validatedData['verification_code_expires_at'] = now()->addMinute();
            
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
     * Logout user dan hapus sesi
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully');
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
                return redirect('/dashboard')->with('success', 'Anda berhasil login dengan Google!');
            } elseif ($userWithSameEmail) {
                // User with same email exists, update their google_id and login
                Log::info('Found user by email, updating google_id', ['user_id' => $userWithSameEmail->id]);
                $userWithSameEmail->update([
                    'google_id' => $googleUser->getId()
                ]);

                Auth::login($userWithSameEmail);
                return redirect('/dashboard')->with('success', 'Anda berhasil login dengan Google!');
            } else {
                // Create a new user with Google account data
                Log::info('Creating new user with Google account');

                // Explicitly create with all required fields
                $newUser = User::create([
                    'nama' => $googleUser->getName(),  // Make sure this is included!
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'sekolah' => 'Belum diisi',
                    'nomer_hp' => 'Belum diisi',
                    'password' => Hash::make(Str::random(16)),
                    'is_admin' => 0
                ]);

                Log::info('New user created', ['user_id' => $newUser->id]);

                // Login the new user
                Auth::login($newUser);

                // Redirect to profile page to complete missing info
                return redirect('/profile/edit')->with('info', 'Akun berhasil dibuat dengan Google. Silakan lengkapi profil Anda.');
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
