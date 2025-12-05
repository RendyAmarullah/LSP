<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

Route::get('/pendaftaran', function() {
    return view ('pendaftaran');
});

Route::get('/pendaftaran', [AuthController::class, 'showRegisterForm']);
Route::post('/pendaftaran', [AuthController::class, 'register']);
Route::middleware('auth')->group(function () {
    Route::get('/cekstatusakun', [AuthController::class, 'statusAkun']);
});