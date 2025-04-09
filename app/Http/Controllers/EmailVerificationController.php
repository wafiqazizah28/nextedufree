<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailVerificationMail;

class EmailVerificationController extends Controller
{
    /**
     * Show verification code form
     */
    public function showVerificationForm()
    {
        $user = auth()->user();
        
        // If user already verified
        if ($user->email_verified_at) {
            return redirect('/dashboard')->with('info', 'Email Anda sudah diverifikasi.');
        }
        
        return view('auth.verify.code', ['email' => $user->email]);
    }
    
    /**
     * Verify the email
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'digit1' => 'required|numeric|digits:1',
            'digit2' => 'required|numeric|digits:1',
            'digit3' => 'required|numeric|digits:1',
            'digit4' => 'required|numeric|digits:1',
        ]);
        
        $user = auth()->user();
        
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
        
        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi. Selamat datang di nextEdu!');
    }
    
    /**
     * Resend verification code
     */
    public function resendVerificationCode()
    {
        $user = auth()->user();
        
        // Generate new 4-digit code
        $code = rand(1000, 9999);
        
        // Update the code in the database
        $user->verification_code = $code;
        $user->reset_code_expires_at = now()->addMinutes(3);
        $user->save();
        
        // Send the email with the code
        Mail::to($user->email)->send(new EmailVerificationMail($code));
        
        return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
}