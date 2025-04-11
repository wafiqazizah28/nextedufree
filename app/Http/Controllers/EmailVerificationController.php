<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $user = auth()->user();
        
        // If user already verified
        if ($user->email_verified_at) {
            return redirect('/dashboard')->with('info', 'Email Anda sudah diverifikasi.');
        }
        
        // Check if session has verified and hideOverlay flags
        $verified = session('verified', false);
         
        return view('auth.verify.code', [
            'email' => $user->email,
            'verified' => $verified,
         ]);
    }
    
    /**
     * Hide verification overlay
     */
   
    
    /**
     * Verify the email
     */
    public function verifyEmail(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login Anda telah berakhir. Silakan login kembali.'
                ]);
            }
            
            return redirect()->route('login')
                ->with('error', 'Sesi login Anda telah berakhir. Silakan login kembali.');
        }
        
        $user = auth()->user();
        
        // Check if request is AJAX
        if ($request->ajax()) {
            // Get the code from request
            $code = $request->verification_code;
            
            // Verify code
            if ($user->verification_code != $code || $user->verification_code_expires_at < now()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode verifikasi tidak valid atau telah kedaluarsa.'
                ]);
            }
            
            // Mark email as verified
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->verification_code_expires_at = null;
            $user->save();
            
            // Set verified flag in session
            session(['verified' => true]);
            
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard'),
                'message' => 'Email berhasil diverifikasi. Selamat datang di nextEdu!'
            ]);
        }
        
        // For non-AJAX requests (fallback)
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
        
        // Mark email as verified
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();
        
        // Set verified flag in session
        session(['verified' => true]);
        
        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi. Selamat datang di nextEdu!');
    }
    
    /**
     * Resend verification code
     */
    public function resendVerificationCode(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login Anda telah berakhir. Silakan login kembali.'
                ]);
            }
            
            return redirect()->route('login')
                ->with('error', 'Sesi login Anda telah berakhir. Silakan login kembali.');
        }
        
        $user = auth()->user();
        
        try {
            // Generate new 4-digit code
            $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Update the code in the database
            $user->verification_code = $code;
            $user->verification_code_expires_at = now()->addMinutes(3);
            $user->save();
            
            // Send the email with the code
            Mail::to($user->email)->send(new EmailVerificationMail($code));
            
            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kode verifikasi baru telah dikirim ke email Anda.'
                ]);
            }
            
            return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
            
        } catch (\Exception $e) {
            Log::error('Error resending verification code', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengirim kode verifikasi.'
                ]);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat mengirim kode verifikasi.');
        }
    }
    
    /**
     * Middleware to check if email is verified
     * Add this method to redirect unverified users
     */
    public function redirectIfUnverified(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $user = auth()->user();
        
        if (!$user->email_verified_at) {
            return redirect()->route('verification.show')
                ->with('error', 'Anda harus memverifikasi email terlebih dahulu.');
        }
        
        return redirect()->route('dashboard');
    }
}