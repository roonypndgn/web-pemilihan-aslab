<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CalonAslabController;
use App\Http\Controllers\KepalaLabController;
use App\Http\Controllers\PengujiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('kepalalab')
    ->name('kepalalab.')
    ->middleware(['auth', 'role:kepala_lab'])
    ->group(function () {
        Route::get('/dashboard', [KepalaLabController::class, 'dashboard'])->name('dashboard');
        Route::get('/periode', [KepalaLabController::class, 'periode'])->name('periode');
        Route::get('/pendaftaran', [KepalaLabController::class, 'pendaftaran'])->name('pendaftaran');
        Route::get('/penguji', [KepalaLabController::class, 'penguji'])->name('penguji');
        Route::get('/pembagian', [KepalaLabController::class, 'pembagian'])->name('pembagian');
        Route::get('/penilaian', [KepalaLabController::class, 'penilaian'])->name('penilaian');
        Route::get('/ahp', [KepalaLabController::class, 'ahp'])->name('ahp');
        Route::get('/laporan', [KepalaLabController::class, 'laporan'])->name('laporan');
        Route::get('/pengaturan', [KepalaLabController::class, 'pengaturan'])->name('pengaturan');
    });

// ========== PENGUJI ROUTES ==========
Route::prefix('penguji')
    ->name('penguji.')
    ->middleware(['auth', 'role:penguji'])
    ->group(function () {
        Route::get('/dashboard', [PengujiController::class, 'dashboard'])->name('dashboard');
        Route::get('/calon-aslab', [PengujiController::class, 'calonAslab'])->name('calon-aslab');
        Route::get('/penilaian', [PengujiController::class, 'penilaian'])->name('penilaian');
        Route::post('/penilaian/store', [PengujiController::class, 'storePenilaian'])->name('penilaian.store');
        Route::get('/jadwal', [PengujiController::class, 'jadwal'])->name('jadwal');
        Route::get('/rekap-nilai', [PengujiController::class, 'rekapNilai'])->name('rekap-nilai');
        Route::get('/panduan', [PengujiController::class, 'panduan'])->name('panduan');
        Route::get('/pengaturan', [PengujiController::class, 'pengaturan'])->name('pengaturan');
    });

// ========== CALON ASLAB ROUTES ==========
Route::prefix('calonaslab')
    ->name('calonaslab.')
    ->middleware(['auth', 'role:calon_aslab'])
    ->group(function () {
        Route::get('/dashboard', [CalonAslabController::class, 'dashboard'])->name('dashboard');
        Route::get('/pendaftaran', [CalonAslabController::class, 'pendaftaran'])->name('pendaftaran');
        Route::post('/pendaftaran/store', [CalonAslabController::class, 'storePendaftaran'])->name('pendaftaran.store');
        Route::get('/status', [CalonAslabController::class, 'status'])->name('status');
        Route::get('/jadwal', [CalonAslabController::class, 'jadwal'])->name('jadwal');
        Route::get('/hasil', [CalonAslabController::class, 'hasil'])->name('hasil');
        Route::get('/panduan', [CalonAslabController::class, 'panduan'])->name('panduan');
        Route::get('/pengaturan', [CalonAslabController::class, 'pengaturan'])->name('pengaturan');
    });