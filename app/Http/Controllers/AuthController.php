<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login user dan generate token API
     */
    public function login()
    {
        return view('pages.login'); // Pastikan ada file resources/views/pages/login.blade.php
    }
    public function register()
    {
        return view('pages.register'); // Pastikan ada file resources/views/pages/register.blade.php
    }

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
     * Register user baru
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
        $user = User::create($validatedData);

        // Generate token setelah user berhasil didaftarkan
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Account registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Logout user (hanya menghapus token yang aktif)
     */
    public function logout(Request $request)
    {
        // dd($request);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully');
    }

    /**
     * Get user yang sedang login
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
