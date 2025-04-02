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
use Laravel\Socialite\Facades\Socialite;

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

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
});

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
    Route::get('/dashboard', [DashboardController::class, 'user']);
    
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