<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\ResetPasswordMail;
use App\Mail\EmailVerificationMail;

class AuthController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // Apply guest middleware to pages only guests should access
        $this->middleware('guest')->except(['logout', 'me']);
        
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

        // First check if the email exists
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            // Email doesn't exist in our database
            return back()
                ->withInput($request->only('remember'))
                ->with('email_error', 'Email tidak terdaftar di sistem kami.')
                ->with('error', 'Email tidak terdaftar di sistem kami.');
        }

        // Now try to authenticate with the given credentials
        if (Auth::attempt($credentials, $remember)) {
            // Check if email is verified (if feature is enabled)
            if ($this->shouldVerifyEmail() && !Auth::user()->hasVerifiedEmail()) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Email belum diverifikasi. Silakan verifikasi email Anda terlebih dahulu.');
            }

            $request->session()->regenerate(); // Prevent session fixation attack
            
            return $this->redirectToDashboard('Login berhasil sebagai ' . Auth::user()->nama);
        }

        // If we get here, the email exists but password is wrong
        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('password_error', 'Password yang Anda masukkan salah.')
            ->with('error', 'Password yang Anda masukkan salah.');
    }

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
            $code = $this->generateVerificationCode();
            
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
            $this->logError('Registration error', $e);
            
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
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

        return redirect('/')->with('success', 'Anda berhasil logout.');
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
            
            // Find existing user by Google ID or email
            $user = $this->findOrCreateGoogleUser($googleUser);

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
            $this->logError('Google login error', $e);

            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
    
    /**
     * Find existing user by Google ID or email or create a new one
     */
    private function findOrCreateGoogleUser($googleUser)
    {
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
        
        return $user;
    }
    
    /**
     * Generate a random 4-digit verification code
     */
    private function generateVerificationCode()
    {
        return str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Log error with context
     */
    private function logError($message, Exception $exception)
    {
        Log::error($message, [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
    
    /**
     * Check if email verification is enabled
     */
    private function shouldVerifyEmail()
    {
        return config('auth.verify_email', true);
    }
    
    /**
     * Redirect to appropriate dashboard based on user role
     */
    private function redirectToDashboard($successMessage)
    {
        return redirect('/adminDashboard')->with('success', $successMessage);
    }
    
}