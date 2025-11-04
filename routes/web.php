<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\PenerimaBantuanController;

Route::get('/', function () {
    return view('welcome'); // atau ganti dengan view lain
});


// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/login-success', [AuthController::class, 'loginSuccess'])->name('login.success');

//logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/register-success', [AuthController::class, 'registerSuccess'])->name('register.success');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('pages.auth.dashboard');

Route::resource('warga', WargaController::class);

Route::resource('penerima_bantuan', PenerimaBantuanController::class);

Route::resource('program_bantuan', ProgramBantuanController::class);

Route::resource('user', UserController::class);



