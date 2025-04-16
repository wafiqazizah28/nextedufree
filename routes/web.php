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
use App\Http\Controllers\FaqController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\kebijakanController;
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
// 📌 Public Routes - Rute Publik yang dapat diakses tanpa login
// ===========================

// Landing Page
Route::get('/', [AppController::class, 'index']);

// Redirect tanyaJurpan jika belum login
Route::get('/tanyaJurpan', function () {
    return Auth::check() 
        ? redirect('/tanyaJurpan/page') 
        : redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
});

// 📌 Authentication - Rute Autentikasi

// Authentication Routes - Rute untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
    
    // Password Reset Routes - Rute untuk reset password
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
});

// Modified login route to check for email verification - Rute login yang telah dimodifikasi
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Google OAuth - Autentikasi menggunakan Google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Public Content - Konten publik
Route::get('/artikelPage', [AppController::class, 'artikel']);
Route::get('/artikel/filter', [AppController::class, 'filterByKategori']);
Route::get('/artikel/search', [AppController::class, 'search']);
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/privacy-policy', [kebijakanController::class, 'index'])->name('privacy-policy');
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');

// Forward Chaining For Guest - Forward Chaining untuk tamu
Route::post('/submit-answer-guest', [AppController::class, 'forwardChainingGuest']);

// AI Generation - Generasi AI
Route::post('/generate', [GenerativeAIController::class, 'generate']);

// ===========================
// 📌 Email Verification Routes - Rute Verifikasi Email
// ===========================

// Rute verifikasi email - dapat diakses setelah login tapi sebelum verifikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'showVerificationForm'])
        ->name('verification.notice');
    Route::get('/email/verify/form', [EmailVerificationController::class, 'showVerificationForm'])
        ->name('verification.show');
    Route::post('/email/verify', [EmailVerificationController::class, 'verifyEmail'])
        ->name('verification.verify');
    Route::post('/email/verify/resend', [EmailVerificationController::class, 'resendVerificationCode'])
        ->name('verification.resend');
});

// ===========================
// 📌 Middleware untuk redirect ke halaman verifikasi email
// ===========================

// Buat middleware 'email_verified' untuk pengguna yang sudah login tapi belum verifikasi email
// Semua rute di bawah ini memerlukan verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard - Dasbor pengguna
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
    
    // Profile Management - Manajemen profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Tanya Jurpan - Fitur tanya jurusan
    Route::get('/tanyaJurpan/page', [AppController::class, 'tanyaJurpan']);
    
    // Hasil Tes - Hasil tes pengguna
    Route::get('/hasiltes/{id}', [HasilTesController::class, 'show'])->name('hasiltes.show');
    Route::get('/tesminatmu', [AppController::class, 'hasilTes'])->name('hasilTes');
    Route::get('/hasil-tes', [HasilTesController::class, 'index']);
    Route::get('/hasil-tes/{id}/download', [HasilTesController::class, 'downloadPDF'])->name('hasil-tes.download');
    
    // Forward Chaining - Proses forward chaining
    Route::post('/submit-answer/{id}', [AppController::class, 'forwardChaining']);
    
    // Sekolah Based on Hasil Tes - Sekolah berdasarkan hasil tes
    Route::get('/sekolah-hasil-tes', [SekolahController::class, 'showByHasilTes'])->name('sekolah.hasilTes');
    Route::post('/testimoni/store', [AppController::class, 'storeTestimoni'])->name('testimoni.store');

    // Testimoni - Testimoni pengguna
});

// ===========================
// 📌 Admin Routes - Rute Admin
// ===========================


Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    // Admin Dashboard - Dasbor admin
    Route::get('/adminDashboard', [DashboardController::class, 'admin']);
 
    // Rules Management - Manajemen aturan
    Route::get('/rules', [AppController::class, 'logicRelation']);
    Route::get('/rules/{id}/edit', [AppController::class, 'edit']);
    Route::post('/rules-change', [AppController::class, 'update']);
    
    // View Testimoni (Admin) - Lihat testimoni (Admin)
    // PDF Exports - Ekspor PDF
    Route::get('/jurusan/export-pdf', [JurusanController::class, 'exportPDF']);
    Route::get('/testimoni/export-pdf', [TestimoniController::class, 'exportPDF'])->name('testimoni.export-pdf');
    Route::get('/saranpekerjaan/export-pdf', [SaranPekerjaanController::class, 'exportPDF']);
    Route::get('/users/export-pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
    
    // Resource Controllers - Controller Resource untuk admin
    Route::resources([
        'pertanyaan' => PertanyaanController::class,
        'jurusan' => JurusanController::class,
        'saranpekerjaan' => SaranPekerjaanController::class,
        'artikels' => ArtikelController::class,
        'users' => UserController::class,
        'sekolah' => SekolahController::class
    ]);
    Route::resource('testimoni', TestimoniController::class)->except(['store']);

    // Admin Sekolah Routes with Custom Names - Rute sekolah admin dengan nama kustom
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
});