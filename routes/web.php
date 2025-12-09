<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PendaftarBantuanController;
use App\Http\Controllers\ProgramBantuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PeristiwaKelahiranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

/*
|--------------------------------------------------------------------------
| DASHBOARD PROTECTED
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard umum
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Dashboard user
    Route::get('/user/dashboard', [DashboardController::class, 'index'])
        ->name('user.dashboard');

    // Dashboard admin (hanya role admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');
    });

    // Resource routes
    Route::resource('warga', WargaController::class);
    Route::resource('program_bantuan', ProgramBantuanController::class);
    Route::resource('user', UserController::class);
    Route::resource('pendaftar_bantuan', PendaftarBantuanController::class);

    // MEDIA FILE ROUTES
    Route::get('warga/{id}/media', [MediaController::class, 'index'])->name('media.index');
    Route::get('warga/{id}/media/upload', [MediaController::class, 'create'])->name('media.create');
    Route::post('warga/{id}/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('warga/{id}/media/{media_id}', [MediaController::class, 'destroy'])->name('media.destroy');

    // PERISTIWA KELAHIRAN
    Route::resource('kelahiran', PeristiwaKelahiranController::class)->names('kelahiran');
});

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
// Jika user belum login, diarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});
