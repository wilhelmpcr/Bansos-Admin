<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftarBantuanController;
use App\Http\Controllers\PenerimaBantuanController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\RiwayatPenyaluranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiLapanganController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login-form');
});

/*
|--------------------------------------------------------------------------
| TEST ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/tes', fn () => 'ROUTE OK');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/
Route::view('/info-program', 'info-program')->name('programs.info');

/*
|--------------------------------------------------------------------------
| AUTH ROUTE (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTE (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('warga', WargaController::class)
        ->names('warga');

    Route::resource('program-bantuan', ProgramBantuanController::class)
        ->names('program_bantuan');

    Route::resource('penerima-bantuan', PenerimaBantuanController::class)
        ->names('penerima_bantuan');

    Route::resource('pendaftar-bantuan', PendaftarBantuanController::class)
        ->names('pendaftar_bantuan');

    Route::resource('verifikasi-lapangan', VerifikasiLapanganController::class)
        ->names('verifikasi_lapangan');

    Route::resource('riwayat-penyaluran', RiwayatPenyaluranController::class)
        ->parameters(['riwayat-penyaluran' => 'riwayat'])
        ->names('riwayat_penyaluran');

    Route::resource('users', UserController::class)
        ->names('user');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});
