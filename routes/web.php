<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Calon_MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranMahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\Calon_Mahasiswa;
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



Route::get('/admin/pembayaran', [PembayaranController::class, 'index2'])->name('admin.pembayaran');
Route::put('/admin/pembayaran/{id}', [PembayaranController::class, 'updateStatus'])->name('admin.pembayaran.update');
    
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::put('/admin/validasi-user/{id}', [AdminController::class, 'validasiUser'])->name('admin.validasi');
    Route::put('/admin/tolak-user/{id}', [App\Http\Controllers\AdminController::class, 'tolakUser'])->name('admin.tolak');
    Route::get('/pengumuman/create', function () {
        return view('admin.create_announcement');
    })->name('admin.pengumuman.create');
    
    
});

Route::middleware(['auth'])->group(function () {
    
   
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    });

});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/akun', [AdminController::class, 'index'])->name('users.index');

});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('pengumuman', PengumumanController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'statusAkun']); 
    Route::get('/admin/dashboard', [AuthController::class, 'pengumuman']);
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'uploadBukti'])->name('pembayaran.upload');
    
    
     
    
    Route::get('/profile', [Calon_MahasiswaController::class, 'showProfil'])->name('profile');
});

Route::get('/pendaftaranmahasiswa/edit', [PendaftaranMahasiswaController::class, 'edit'])->name('pendaftaranmahasiswa.edit');
Route::put('/pendaftaranmahasiswa/update', [PendaftaranMahasiswaController::class, 'update'])->name('pendaftaranmahasiswa.update');
Route::get('/pendaftaranmahasiswa', [PendaftaranMahasiswaController::class, 'create'])->name('pendaftaranmahasiswa.create');
Route::post('/pendaftaranmahasiswa', [PendaftaranMahasiswaController::class, 'store'])->name('pendaftaranmahasiswa.store');

Route::get('/admin/calonmahasiswa', [Calon_MahasiswaController::class, 'index'])->name('admin.calonmahasiswa');
Route::put('/admin/calonmahasiswa/{id}/update-status', [Calon_MahasiswaController::class, 'updateStatus'])
    ->name('admin.calonmahasiswa.updateStatus');

 Route::get('/', [WelcomeController::class, 'index']);