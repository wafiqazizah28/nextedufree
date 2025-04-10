<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SaranPekerjaanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenerativeAIController;
use App\Http\Controllers\HasilTesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilTesShareController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailVerificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ===========================
// 📌 Public Routes
// ===========================

// Landing Page
Route::get('/', [AppController::class, 'index']);

Route::get('/tanyaJurpan', function () {
    return Auth::check() 
        ? redirect('/tanyaJurpan/page') 
        : redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // ✅ HARUS PUT
});

// Middleware auth memastikan hanya user yang login bisa mengakses
Route::get('/tanyaJurpan/page', [AppController::class, 'tanyaJurpan'])->middleware('auth');
Route::get('/artikelPage', [AppController::class, 'artikel']);
Route::post('/generate', [GenerativeAIController::class, 'generate']);

// 📌 Halaman hasil tes (User yang sudah login dapat melihat sekolah berdasarkan hasil tes)
Route::middleware('auth')->group(function () {
    Route::get('/tesminatmu', [AppController::class, 'hasilTes'])->name('hasilTes');
    Route::get('/hasiltes', [AppController::class, 'hasilTes'])->name('hasilTes');
    Route::get('/admin/hasiltess', [HasilTesController::class, 'index'])->name('components.admin.hasiltes');
});

// 📌 Authentication

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
});

Route::get('/testhistory', [App\Http\Controllers\AppController::class, 'showTestHistory'])->name('testdetail');
Route::get('/testdetail/{id}', [App\Http\Controllers\AppController::class, 'showDetail'])->name('testdetail.detail');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Public Content
Route::get('/artikelPage', [AppController::class, 'artikel']);
Route::get('/artikel/filter', [AppController::class, 'filterByKategori']);
Route::get('/artikel/search', [AppController::class, 'search']);

// Forward Chaining For Guest
Route::post('/submit-answer-guest', [AppController::class, 'forwardChainingGuest']);

// AI Generation
Route::post('/generate', [GenerativeAIController::class, 'generate']);

// Redirect to login if not authenticated
Route::get('/tanyaJurpan', function () {
    return Auth::check() 
        ? redirect('/tanyaJurpan/page') 
        : redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
});

// ===========================
// 📌 Authenticated User Routes
// ===========================

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');

    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Tanya Jurpan
    Route::get('/tanyaJurpan/page', [AppController::class, 'tanyaJurpan']);
    
    // Hasil Tes
    Route::get('/tesminatmu', [AppController::class, 'hasilTes'])->name('hasilTes');
    Route::get('/hasiltes', [HasilTesController::class, 'index']);
    
    // Forward Chaining
    Route::post('/submit-answer/{id}', [AppController::class, 'forwardChaining']);
    
    // Sekolah Based on Hasil Tes
    Route::get('/sekolah-hasil-tes', [SekolahController::class, 'showByHasilTes'])->name('sekolah.hasilTes');
    
    // Testimoni
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('user.testimoni.store');
});

// ===========================
// 📌 Admin Routes
// ===========================

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/adminDashboard', [DashboardController::class, 'admin']);
    
    // Rules Management
    Route::get('/rules', [AppController::class, 'logicRelation']);
    Route::get('/rules/{id}/edit', [AppController::class, 'edit']);
    Route::post('/rules-change', [AppController::class, 'update']);
    
    // View Testimoni (Admin)
    Route::get('/admin/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.view');
    
    // PDF Exports
    Route::get('/jurusan/export-pdf', [JurusanController::class, 'exportPDF']);
});

// ===========================
// 📌 Resource Routes
// ===========================

// PDF Export Routes (must be before resource routes to avoid conflicts)
Route::get('/testimoni/export-pdf', [TestimoniController::class, 'exportPDF'])->name('testimoni.export-pdf');
Route::get('/saranpekerjaan/export-pdf', [SaranPekerjaanController::class, 'exportPDF']);
// Resource Controllers
Route::resources([
    'pertanyaan' => PertanyaanController::class,
    'jurusan' => JurusanController::class,
    'saranpekerjaan' => SaranPekerjaanController::class,
    'artikels' => ArtikelController::class,
    'users' => UserController::class,
    'testimoni' => TestimoniController::class,
    'sekolah' => SekolahController::class
]);

// ===========================
// 📌 Named Route Overrides
// ===========================

// Admin Sekolah Routes with Custom Names
Route::prefix('admin')->group(function () {
    Route::resource('sekolah', SekolahController::class)
        ->names([
            'index' => 'components.admin.sekolah.index',
            'create' => 'components.admin.sekolah.create',
            'store' => 'components.admin.sekolah.store', 
            'show' => 'components.admin.sekolah.show',
            'edit' => 'components.admin.sekolah.edit',
            'update' => 'components.admin.sekolah.update', 
            'destroy' => 'components.admin.sekolah.destroy',
        ]);
});

// Ensure public access to sekolah index
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
// Add this route to your web.php routes file

// PDF Export route
Route::get('/users/export-pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');



 

// Route untuk mengunduh hasil tes sebagai PDF
Route::get('/hasil-tes/{id}/download', [HasilTesController::class, 'downloadPDF'])->name('hasil-tes.download');

// Route untuk melihat hasil tes
Route::get('/hasil-tes/{id}', [HasilTesController::class, 'show'])->name('hasil-tes.show');
Route::get('/hasil-tes/{hasilTes}/generate-share-image', [HasilTesShareController::class, 'generateShareImage']);
// Password Reset Routes
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetCode'])
    ->name('password.email');
Route::get('/reset-password/code', [PasswordResetController::class, 'showCodeForm'])
    ->name('password.code');
Route::post('/reset-password/code', [PasswordResetController::class, 'verifyCode'])
    ->name('password.code.verify');
Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');
Route::post('/reset-password/resend', [PasswordResetController::class, 'resendCode'])
    ->name('password.code.resend');

// Email Verification Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'sendVerificationCode'])
        ->name('verification.notice');
    Route::get('/email/verify/code', [EmailVerificationController::class, 'showVerificationForm'])
        ->name('email.verify.code');
    Route::post('/email/verify/code', [EmailVerificationController::class, 'verifyEmail'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resendVerificationCode'])
        ->name('verification.resend');
});