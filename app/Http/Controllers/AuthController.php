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
            $redirectLink = Auth::user()->is_admin ? '/adminDashboard' : '/dashboard';

            return redirect()->intended($redirectLink)->with('success', 'Logged in successfully as ' . Auth::user()->nama);
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
            'nomer_hp' => 'required|string|max:15|unique:users,nomer_hp',
            'password' => 'required|min:6|max:10|confirmed'
        ]);

        // Hash password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_admin'] = 0; // Default user biasa

        // Simpan user ke database
        User::create($validatedData);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
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
     */   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
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
            
            $findUser = User::where('google_id', $googleUser->getId())->first();
            
            // Check if user exists with same email regardless of google_id
            $userWithSameEmail = User::where('email', $googleUser->getEmail())->first();
            
            if ($findUser) {
                // User found by google_id, login
                Log::info('Found user by google_id', ['user_id' => $findUser->id]);
                Auth::login($findUser);
                return redirect('/dashboard')->with('success', 'Anda berhasil login dengan Google!');
            } 
            elseif ($userWithSameEmail) {
                // User with same email exists, update their google_id and login
                Log::info('Found user by email, updating google_id', ['user_id' => $userWithSameEmail->id]);
                $userWithSameEmail->update([
                    'google_id' => $googleUser->getId()
                ]);
                
                Auth::login($userWithSameEmail);
                return redirect('/dashboard')->with('success', 'Anda berhasil login dengan Google!');
            }
            else {
                // Create a new user
                Log::info('Creating new user with Google account');
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)) // Random password
                ]);
                
                Log::info('New user created', ['user_id' => $newUser->id]);
                Auth::login($newUser);
                return redirect('/dashboard')->with('success', 'Akun Anda berhasil dibuat dan login dengan Google!');
            }
        } catch (Exception $e) {
            // Detailed error logging
            Log::error('Google login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'previous' => $e->getPrevious() ? $e->getPrevious()->getMessage() : null
            ]);
            
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google. Detail: ' . $e->getMessage());
        }
    }
    
}
