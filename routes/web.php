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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenerativeAIController;
use App\Http\Controllers\HasilTesController;
use Laravel\Socialite\Facades\Socialite;

// 📌 Halaman utama
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
});

// 📌 Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register']);
});

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// 📌 Dashboard
Route::get('/dashboard', [DashboardController::class, 'user'])->middleware('auth');

// 📌 Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/adminDashboard', [DashboardController::class, 'admin']);
    
    // 📌 Rules
    Route::get('/rules', [AppController::class, 'logicRelation']);
    Route::get('/rules/{id}/edit', [AppController::class, 'edit']);
    Route::post('/rules-change', [AppController::class, 'update']);
    
    // 📌 Testimoni - Admin hanya bisa melihat
    Route::get('/admin/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.view');
    
    // 📌 Sekolah - Admin bisa CRUD sekolah
    Route::resource('/admin/sekolah', SekolahController::class);
});

// 📌 Sistem Pakar
Route::post('/submit-answer/{id}', [AppController::class, 'forwardChaining']);
Route::post('/submit-answer-guest', [AppController::class, 'forwardChainingGuest']);
Route::get('/hasiltes', [HasilTesController::class, 'index'])->middleware('auth');

// 📌 Resource Routes
Route::resources([
    'pertanyaan' => PertanyaanController::class,
    'jurusans' => JurusanController::class,
    'saranpekerjaan' => SaranPekerjaanController::class,
    'artikels' => ArtikelController::class,
    'users' => UserController::class,
    'testimoni' => TestimoniController::class,
    'sekolah' => SekolahController::class

]);

// 📌 User authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('user.testimoni.store');
    
    // 📌 Rute untuk user biasa melihat sekolah berdasarkan hasil tes
    Route::get('/sekolah-hasil-tes', [SekolahController::class, 'showByHasilTes'])->name('sekolah.hasilTes');
});

Route::prefix('admin')->group(function () {
    Route::resource('sekolahs', SekolahController::class)
        ->names([
            'index' => 'components.admin.sekolahs.index',
            'create' => 'components.admin.sekolahs.create',
            'store' => 'components.admin.sekolahs.store', 
            'show' => 'components.admin.sekolahs.show',
            'edit' => 'components.admin.sekolahs.edit',
            'update' => 'components.admin.sekolahs.update', 
            'destroy' => 'components.admin.sekolahs.destroy',
        ]);
});

// 📌 Pastikan route `/sekolah` tetap tersedia jika di luar admin
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
Route::put('/sekolah/{sekolah}', [SekolahController::class, 'update'])->name('sekolah.update');
// 📌 Route untuk daftar saran pekerjaan
Route::get('/saranpekerjaanList', [SaranPekerjaanController::class, 'index'])->name('saranpekerjaan.index');

// 📌 Gunakan Resource Controller untuk CRUD Saran Pekerjaan
Route::resource('saranpekerjaan', SaranPekerjaanController::class);
<<<<<<< HEAD
Route::get('/artikels/filter', [AppController::class, 'filterByKategori']);
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
=======

Route::get('/saranpekerjaan', [SaranPekerjaanController::class, 'index'])
    ->name('documents.admin.saranpekerjaan.index');
>>>>>>> 995422f528f5cf0f569a65286405bf5f7063c259
