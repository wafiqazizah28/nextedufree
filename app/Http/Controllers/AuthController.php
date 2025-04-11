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
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // Apply guest middleware to pages only guests should access
        $this->middleware('guest')->except(['logout', 'me', 'verifyEmail']);
        
        // Apply auth middleware to pages that require authentication
        $this->middleware('auth')->only(['logout', 'me']);
    }

    /**
     * Display login page
     */
    public function login()
    {
        return view('pages.login');
    }

    /**
     * Display registration page
     */
    public function register()
    {
        return view('pages.register');
    }

    /**
     * Process user authentication
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            // Check if email is verified (if feature is enabled)
            if (config('auth.verify_email', true) && !Auth::user()->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Email belum diverifikasi. Silakan verifikasi email Anda terlebih dahulu.');
            }

            $request->session()->regenerate(); // Prevent session fixation attack

            // Determine redirect based on user role
            $redirectTo = Auth::user()->is_admin ? route('admin.dashboard') : route('dashboard');
            
            return redirect()->intended($redirectTo)
                ->with('success', 'Login berhasil sebagai ' . Auth::user()->nama);
        }

        // Do not reveal which credential was incorrect for security
        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', 'Kredensial yang Anda berikan tidak cocok dengan data kami.');
    }

    /**
     * Register new user (temporarily store data until verification)
     */    
    /**
     * Register new user
     */
    public function store(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomer_hp' => 'required|regex:/^[0-9]+$/|min:10|max:15|unique:users,nomer_hp',
            'password' => 'required|min:8|confirmed'
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'nomer_hp.unique' => 'Nomor HP harus angka dan belum terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);
    
        try {
            // Generate verification code
            $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Create user in database
            $user = User::create([
                'nama' => $validatedData['nama'],
                'sekolah' => $validatedData['sekolah'],
                'email' => $validatedData['email'],
                'nomer_hp' => $validatedData['nomer_hp'],
                'password' => Hash::make($validatedData['password']),
                'is_admin' => 0,
                'verification_code' => $code,
                'verification_code_expires_at' => now()->addMinutes(3)
            ]);
            
            // Send verification email
            Mail::to($user->email)->send(new EmailVerificationMail($code));
            
            // Log the user in
            Auth::login($user);
            
            // Redirect to verification page
            return redirect()->route('verification.show')
                ->with('success', 'Silakan masukkan kode verifikasi yang telah dikirim ke email Anda.');
                
        } catch (Exception $e) {
            Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    /**
     * Verify email with code and create user if verified
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|numeric|min:100000|max:999999',
            'token' => 'required|string'
        ]);

        // Retrieve the pending user data from cache
        $pendingUserData = Cache::get('pending_user_' . $request->token);
        
        if (!$pendingUserData) {
            return back()->with('error', 'Sesi verifikasi telah kedaluwarsa. Silakan daftar ulang.');
        }
        
        // Check if the verification code matches
        if ($pendingUserData['verification_code'] != $request->verification_code) {
            return back()->with('error', 'Kode verifikasi tidak valid.');
        }
        
        // Check if the email matches (additional security)
        if ($pendingUserData['user_data']['email'] != $request->email) {
            return back()->with('error', 'Email tidak cocok dengan data pendaftaran.');
        }
        
        // Check if verification has expired
        if (now()->isAfter($pendingUserData['expires_at'])) {
            // Clean up expired data
            Cache::forget('pending_user_' . $request->token);
            return back()->with('error', 'Kode verifikasi telah kedaluwarsa. Silakan daftar ulang.');
        }
        
        try {
            // Create user in database now that verification is complete
            $userData = $pendingUserData['user_data'];
            $userData['email_verified_at'] = now(); // Mark as verified
            
            $user = User::create($userData);
            
            // Clean up temporary data
            Cache::forget('pending_user_' . $request->token);
            
            // Automatically login after verification
            Auth::login($user);
            
            return redirect()->route('dashboard')
                ->with('success', 'Email berhasil diverifikasi. Akun telah dibuat. Selamat datang!');
                
        } catch (Exception $e) {
            Log::error('User creation after verification error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
        }
    }

    /**
     * Show email verification form
     */
    public function showVerificationForm()
    {
        // Check if user is authenticated first
        if (!auth()->check()) {
            // Redirect to login page if no user is authenticated
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $user = auth()->user();
        
        // If user already verified
        if ($user->email_verified_at) {
            return redirect('/dashboard')->with('info', 'Email Anda sudah diverifikasi.');
        }
        
         $verified = session('verified', false);
         
        return view('auth.verify.code', [
            'email' => $user->email,
            'verified' => $verified,
         ]);
    }
    

    /**
     * Resend verification code
     */
    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string'
        ]);

        // Get pending user data
        $pendingUserData = Cache::get('pending_user_' . $request->token);
        
        if (!$pendingUserData) {
            return back()->with('error', 'Sesi pendaftaran telah kedaluwarsa. Silakan daftar ulang.');
        }
        
        // Check if the email matches
        if ($pendingUserData['user_data']['email'] != $request->email) {
            return back()->with('error', 'Email tidak cocok dengan data pendaftaran.');
        }
        
        // Check if last code was sent recently
        $lastCodeTime = $pendingUserData['expires_at']->subHours(1); // Original creation time
        if (now()->diffInMinutes($lastCodeTime) < 5) {
            return back()->with('error', 'Silakan tunggu beberapa menit sebelum meminta kode baru.');
        }

        // Generate new code
        $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Update the verification code in cache
        $pendingUserData['verification_code'] = $code;
        $pendingUserData['expires_at'] = now()->addHours(1);
        
        Cache::put('pending_user_' . $request->token, $pendingUserData, 3600);

        // Send new verification email
        Mail::to($request->email)->send(new EmailVerificationMail($code));

        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
    
    /**
     * Show password reset request form
     */
    public function showForgotPasswordForm()
    {
        return view('pages.forgot-password');
    }
    
    /**
     * Process password reset request
     */
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        // Generate token
        $token = Str::random(64);
        
        // Store reset token in database
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
        
        // Send password reset email
        Mail::to($request->email)->send(new ResetPasswordMail($token));
        
        return back()->with('success', 'Kami telah mengirimkan tautan reset password ke email Anda.');
    }
    
    /**
     * Show password reset form
     */
    public function showResetPasswordForm($token)
    {
        return view('pages.reset-password', ['token' => $token]);
    }
    
    /**
     * Process password reset
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);
        
        // Check if token is valid
        $resetRecord = \DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('created_at', '>', now()->subHours(1))
            ->first();
            
        if (!$resetRecord) {
            return back()->with('error', 'Token reset password tidak valid atau sudah kedaluwarsa.');
        }
        
        // Update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        
        // Delete used token
        \DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();
            
        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
    
    /**
     * Logout user and invalidate session
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    /**
     * Get current authenticated user
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find existing user by Google ID
            $user = User::where('google_id', $googleUser->getId())->first();

            // If no user found by Google ID, check by email
            if (!$user) {
                $user = User::where('email', $googleUser->getEmail())->first();
                
                // If user found by email, link Google account
                if ($user) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'email_verified_at' => $user->email_verified_at ?? now()
                    ]);
                } else {
                    // Create new user with Google data
                    $user = User::create([
                        'nama' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'sekolah' => 'Belum diisi',
                        'nomer_hp' => 'Belum diisi',
                        'password' => Hash::make(Str::random(24)),
                        'is_admin' => 0,
                        'email_verified_at' => now()
                    ]);
                    
                    // Flag for profile completion
                    session(['complete_profile' => true]);
                }
            }

            // Login user
            Auth::login($user, true);
            
            // Redirect based on profile completion status
            if (session('complete_profile')) {
                session()->forget('complete_profile');
                return redirect()->route('profile.edit')
                    ->with('info', 'Akun berhasil dibuat dengan Google. Silakan lengkapi profil Anda.');
            }
            
            return redirect()->route('dashboard')
                ->with('success', 'Anda berhasil login dengan Google!');
                
        } catch (Exception $e) {
            Log::error('Google login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}