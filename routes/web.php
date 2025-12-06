<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

// Route::get('/pendaftaran', function() {
//     return view ('pendaftaran');
// });

Route::get('/pendaftaran', [AuthController::class, 'showRegisterForm']);
Route::post('/pendaftaran', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    Route::get('/cekstatusakun', [AuthController::class, 'statusAkun']);
});

Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::post('/logout', [PendaftaranController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AuthController::class, 'statusAkun'])->name('admin.dashboard');
    
    // Contoh rute Admin lainnya
    Route::get('/pengumuman/create', function () {
        return view('admin.create_announcement');
    })->name('admin.pengumuman.create');
    
    Route::get('/akun-mahasiswa', function () {
        return view('admin.manage_accounts');
    })->name('admin.akun');
    
});