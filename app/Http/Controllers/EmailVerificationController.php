<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class EmailVerificationController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // Apply auth middleware to verification routes that require authentication
        $this->middleware('auth')->only([
            'showVerificationForm', 
            'verifyEmail', 
            'resendVerificationCode',
         ]);
    }
    
    /**
     * Show verification code form
     */
    public function showVerificationForm()
    {
        // Check if user is authenticated
        if (!$this->isUserAuthenticated()) {
            return $this->redirectToLogin('Anda harus login terlebih dahulu.');
        }
        
        $user = Auth::user();
        
        // If user already verified
        if ($user->email_verified_at) {
            return redirect('/dashboard')->with('info', 'Email Anda sudah diverifikasi.');
        }
        
        // Check if session has verified flag
        $verified = session('verified', false);
         
        return view('auth.verify.code', [
            'email' => $user->email,
            'verified' => $verified,
         ]);
    }
    
    /**
     * Verify the email
     */
    public function verifyEmail(Request $request)
    {
        // Check if user is authenticated
        if (!$this->isUserAuthenticated()) {
            return $this->handleUnauthenticatedResponse($request, 'Sesi login Anda telah berakhir. Silakan login kembali.');
        }
        
        $user = Auth::user();
        
        // Handle AJAX request
        if ($request->ajax()) {
            return $this->handleAjaxVerification($request, $user);
        }
        
        // Handle form submission (non-AJAX fallback)
        return $this->handleFormVerification($request, $user);
    }
    
    /**
     * Resend verification code
     */
    public function resendVerificationCode(Request $request)
    {
        // Check if user is authenticated
        if (!$this->isUserAuthenticated()) {
            return $this->handleUnauthenticatedResponse($request, 'Sesi login Anda telah berakhir. Silakan login kembali.');
        }
        
        $user = Auth::user();
        
        try {
            // Generate new 4-digit code
            $code = $this->generateVerificationCode();
            
            // Update the code in the database
            $user->verification_code = $code;
            $user->verification_code_expires_at = now()->addMinutes(3);
            $user->save();
            
            // Send the email with the code
            $this->sendVerificationEmail($user->email, $code);
            
            // Return response based on request type
            return $this->handleSuccessResponse(
                $request, 
                'Kode verifikasi baru telah dikirim ke email Anda.'
            );
            
        } catch (\Exception $e) {
            $this->logError('Error resending verification code', $e);
            
            return $this->handleErrorResponse(
                $request, 
                'Terjadi kesalahan saat mengirim kode verifikasi.'
            );
        }
    }
    
    /**
     * Verify email with code and create user if verified
     * This is used for the verification flow from register process
     */
    public function verifyEmailWithCode(Request $request)
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
                
        } catch (\Exception $e) {
            $this->logError('User creation after verification error', $e);

            return back()->with('error', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
        }
    }
    
    /**
     * Resend verification code during registration
     */
    public function resendRegistrationVerificationCode(Request $request)
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
        $code = $this->generateVerificationCode();
        
        // Update the verification code in cache
        $pendingUserData['verification_code'] = $code;
        $pendingUserData['expires_at'] = now()->addHours(1);
        
        Cache::put('pending_user_' . $request->token, $pendingUserData, 3600);

        // Send new verification email
        $this->sendVerificationEmail($request->email, $code);

        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
    
    /**
     * Middleware to check if email is verified
     * Add this method to redirect unverified users
     */
    public function redirectIfUnverified(Request $request)
    {
        // Check if user is authenticated
        if (!$this->isUserAuthenticated()) {
            return $this->redirectToLogin('Anda harus login terlebih dahulu.');
        }
        
        $user = auth()->user();
        
        if (!$user->email_verified_at) {
            return redirect()->route('verification.show')
                ->with('error', 'Anda harus memverifikasi email terlebih dahulu.');
        }
        
        return redirect()->route('dashboard');
    }
    
    /**
     * Handle AJAX verification request
     */
    private function handleAjaxVerification(Request $request, User $user)
    {
        // Get the code from request
        $code = $request->verification_code;
        
        // Verify code
        if ($user->verification_code != $code || $user->verification_code_expires_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid atau telah kedaluarsa.'
            ]);
        }
        
        $this->markEmailAsVerified($user);
        
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard'),
            'message' => 'Email berhasil diverifikasi. Selamat datang di nextEdu!'
        ]);
    }
    
    /**
     * Handle form verification request (non-AJAX)
     */
    private function handleFormVerification(Request $request, User $user)
    {
        $request->validate([
            'digit1' => 'required|numeric|digits:1',
            'digit2' => 'required|numeric|digits:1',
            'digit3' => 'required|numeric|digits:1',
            'digit4' => 'required|numeric|digits:1',
        ]);
        
        // Combine digits
        $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;
        
        // Verify code
        if ($user->verification_code != $code || $user->verification_code_expires_at < now()) {
            return back()->with('error', 'Kode verifikasi tidak valid atau telah kedaluarsa.');
        }
        
        $this->markEmailAsVerified($user);
        
        return redirect()->route('dashboard')
            ->with('success', 'Email berhasil diverifikasi. Selamat datang di nextEdu!');
    }
    
    /**
     * Mark user's email as verified
     */
    private function markEmailAsVerified(User $user)
    {
        // Mark email as verified
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();
        
        // Set verified flag in session
        session(['verified' => true]);
    }
    
    /**
     * Generate a random 4-digit verification code
     */
    private function generateVerificationCode()
    {
        return str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Send verification email with code
     */
    private function sendVerificationEmail($email, $code)
    {
        Mail::to($email)->send(new EmailVerificationMail($code));
    }
    
    /**
     * Check if user is authenticated
     */
    private function isUserAuthenticated()
    {
        return Auth::check();
    }
    
    /**
     * Redirect to login page with error message
     */
    private function redirectToLogin($message)
    {
        return redirect()->route('login')->with('error', $message);
    }
    
    /**
     * Handle response for unauthenticated user
     */
    private function handleUnauthenticatedResponse(Request $request, $message)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message
            ]);
        }
        
        return $this->redirectToLogin($message);
    }
    
    /**
     * Handle success response based on request type
     */
    private function handleSuccessResponse(Request $request, $message)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        }
        
        return back()->with('success', $message);
    }
    
    /**
     * Handle error response based on request type
     */
    private function handleErrorResponse(Request $request, $message)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message
            ]);
        }
        
        return back()->with('error', $message);
    }
    
    /**
     * Log error with context
     */
    private function logError($message, \Exception $exception)
    {
        Log::error($message, [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}