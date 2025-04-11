<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    /**
     * Show the form to request a password reset link
     */
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }
    
    /**
     * Send password reset email with code
     */
    public function sendResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ], [
        'email.exists' => 'Email tidak ditemukan dalam sistem kami.'
    ]);
    
    // Generate 4-digit code
    $code = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    
    // Store the code in the database with expiry time (3 minutes)
    $user = User::where('email', $request->email)->first();
    $user->reset_code = $code;
    $user->reset_code_expires_at = now()->addMinutes(3);
    $user->save();
    
    // Send the email with the code
    Mail::to($request->email)->send(new ResetPasswordMail($code));
    
    // Store email in session for verification page
    session(['reset_email' => $request->email]);
    
    return redirect()->route('password.code')->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
}
    
    /**
     * Show verification code form
     */
    public function showCodeForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }
        
        return view('auth.passwords.code', ['email' => session('reset_email')]);
    }
    
    /**
     * Verify the reset code
     */
  /**
 * Verify the reset code
 */
public function verifyCode(Request $request)
{
    $request->validate([
        'digit1' => 'required|numeric|digits:1',
        'digit2' => 'required|numeric|digits:1',
        'digit3' => 'required|numeric|digits:1',
        'digit4' => 'required|numeric|digits:1',
    ]);
    
    $email = session('reset_email');
    if (!$email) {
        return redirect()->route('password.request')
            ->with('error', 'Sesi telah berakhir. Silakan mulai ulang proses reset password.');
    }
    
    // Combine digits
    $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;
    
    // Add debugging
    Log::info('Verifying code', [
        'email' => $email,
        'code' => $code,
        'time' => now()
    ]);
    
    // Verify code
    $user = User::where('email', $email)
        ->where('reset_code', $code)
        ->where('reset_code_expires_at', '>', now())
        ->first();
    
    if (!$user) {
        // Add debugging for failed verification
        Log::warning('Invalid code', [
            'email' => $email,
            'code' => $code,
            'found_user' => User::where('email', $email)->first() ? 'Yes' : 'No'
        ]);
        
        return back()->with('error', 'Kode verifikasi tidak valid atau telah kedaluarsa.');
    }
    
    // Store token in session for password reset form
    $token = Str::random(60);
    session(['reset_token' => $token]);
    
    // Store token in database
    $user->reset_token = $token;
    $user->save();
    
    // Add debugging for successful verification
    Log::info('Verification successful', [
        'email' => $email,
        'redirecting_to' => 'password.reset'
    ]);
    
    return redirect()->route('password.reset');
}
    /**
     * Show the new password form
     */
    public function showResetForm()
    {
        if (!session('reset_email') || !session('reset_token')) {
            return redirect()->route('password.request');
        }
        
        return view('auth.passwords.reset', [
            'email' => session('reset_email'),
            'token' => session('reset_token')
        ]);
    }
    
    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6|max:10',
        ]);
        
        // Verify token
        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->first();
            
        if (!$user) {
            return back()->with('error', 'Token tidak valid.');
        }
        
        // Reset password
        $user->password = Hash::make($request->password);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->reset_token = null;
        $user->save();
        
        // Clear session
        session()->forget(['reset_email', 'reset_token']);
        
        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru Anda.');
    }
    
    /**
     * Resend verification code
     */
    public function resendCode()
{
    $email = session('reset_email');
    if (!$email) {
        return redirect()->route('password.request');
    }
    
    // Generate new 4-digit code
    $code = rand(1000, 9999);
    
    // Update the code in the database
    $user = User::where('email', $email)->first();
    $user->reset_code = $code;
    $user->reset_code_expires_at = now()->addMinutes(3);
    $user->save();
    
    // Send the email with the code
    Mail::to($email)->send(new ResetPasswordMail($code));
    
    return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
}
}