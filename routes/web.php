<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\PenerimaBantuanController;

Route::get('/', function () {
    return view('welcome'); // atau ganti dengan view lain
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('warga', WargaController::class);

Route::resource('penerima_bantuan', PenerimaBantuanController::class);

Route::resource('program_bantuan', ProgramBantuanController::class);


Route::resource('user', UserController::class);
