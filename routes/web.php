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
use App\Http\Controllers\GenerativeAIController;

// 📌 Halaman utama
Route::get('/', [AppController::class, 'index']);
Route::get('/tesMinatmu', [AppController::class, 'hasilTes'])->middleware('auth');
Route::get('/tanyaJurpan', [AppController::class, 'tanyaJurpan']);
Route::get('/artikelPage', [AppController::class, 'artikel']);
Route::post('/generate', [GenerativeAIController::class, 'generate']);

// 📌 Halaman hasil tes (User yang sudah login dapat melihat sekolah berdasarkan hasil tes)
Route::get('/tesMinatmu', [AppController::class, 'hasilTes'])->name('hasilTes')->middleware('auth');
Route::get('/hasil-tes', [AppController::class, 'hasilTes'])->name('hasilTes')->middleware('auth');

// 📌 Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// 📌 Dashboard
Route::get('/dashboard', [DashboardController::class, 'user'])->middleware('auth');
Route::get('/adminDashboard', [DashboardController::class, 'admin'])->middleware('admin');


// 📌 Rules
Route::get('/rules', [AppController::class, 'logicRelation']);
Route::get('/rules/{id}/edit', [AppController::class, 'edit']);
Route::post('/rules-change', [AppController::class, 'update']);

// 📌 Sistem Pakar
Route::post('/submit-answer/{id}', [AppController::class, 'forwardChaining']);
Route::post('/submit-answer-guest', [AppController::class, 'forwardChainingGuest']);

// 📌 Resource Routes
Route::resources([
    'pertanyaans' => PertanyaanController::class,
    'jurusans' => JurusanController::class,
    'saranpekerjaans' => SaranPekerjaanController::class,
    'artikels' => ArtikelController::class,
    'users' => UserController::class,
    'testimoni' => TestimoniController::class,
    
]);

// 📌 Rute untuk Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // 📌 Testimoni - Admin hanya bisa melihat
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.view'); 
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->middleware('auth')->name('user.testimoni.store');

    // 📌 Sekolah - Admin bisa CRUD sekolah
    Route::resource('/sekolah', SekolahController::class);
});


// 📌 Rute untuk user biasa melihat sekolah berdasarkan hasil tes
Route::get('/sekolah-hasil-tes', [SekolahController::class, 'showByHasilTes'])
    ->name('sekolah.hasilTes')
    ->middleware('auth');

// 📌 Pastikan route `/sekolah` tetap tersedia jika di luar admin
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');

Route::get('/saranpekerjaanList', [SaranPekerjaanController::class, 'index']);