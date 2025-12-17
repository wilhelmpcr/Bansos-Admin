<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftarBantuanController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\RiwayatPenyaluranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiLapanganController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| TEST ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/tes', function () {
    return 'ROUTE OK';
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/
Route::view('/info-program', 'info-program')
    ->name('programs.info');

/*
|--------------------------------------------------------------------------
| LOGIN ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROGRAM BANTUAN
    |--------------------------------------------------------------------------
    */
    Route::resource('program-bantuan', ProgramBantuanController::class)
        ->names('program_bantuan')
        ->parameters([
            'program-bantuan' => 'program_id',
        ]);

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class)
        ->names('user');

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PENYALURAN
    |--------------------------------------------------------------------------
    */
    Route::resource('riwayat-penyaluran', RiwayatPenyaluranController::class)
        ->names('riwayat_penyaluran');

    /*
    |--------------------------------------------------------------------------
    | PENDAFTAR BANTUAN
    |--------------------------------------------------------------------------
    */
    Route::resource('pendaftar-bantuan', PendaftarBantuanController::class)
        ->names('pendaftar_bantuan');

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI LAPANGAN  ✅ FIX FINAL
    |--------------------------------------------------------------------------
    */
    Route::resource(
        'verifikasi-lapangan',
        VerifikasiLapanganController::class
    )->names('verifikasi_lapangan');
    /*
    |--------------------------------------------------------------------------
    | WARGA
    |--------------------------------------------------------------------------
    */
    Route::resource('warga', WargaController::class);

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| DEFAULT ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});
