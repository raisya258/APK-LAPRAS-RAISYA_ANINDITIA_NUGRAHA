<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    AuthController,
    AspirasiController,
    KategoriController,
    UserController
};

Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    return view('index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [AspirasiController::class, 'adminDashboard']);
    Route::get('/siswa/dashboard', [AspirasiController::class, 'siswaDashboard']);

    Route::get('/input-aspirasi', [AspirasiController::class, 'create']);
    Route::post('/input-aspirasi', [AspirasiController::class, 'store']);
    Route::get('/history-aspirasi', [AspirasiController::class, 'history']);
    Route::get('/siswa/aspirasi/{id}', [AspirasiController::class, 'detailSiswa'])
        ->where('id', '[0-9]+');

    Route::get('/admin/siswa', [UserController::class, 'index']);
    Route::get('/admin/aspirasi', [AspirasiController::class, 'dataAspirasi']);
    Route::get('/admin/aspirasi/{id}', [AspirasiController::class, 'detailAspirasi'])
        ->where('id', '[0-9]+');
    Route::post('/admin/aspirasi/update', [AspirasiController::class, 'updateStatus']);

    Route::delete('/admin/aspirasi/{id}', [AspirasiController::class, 'destroy']);

    // KATEGORI
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::post('/admin/kategori', [KategoriController::class, 'store']);
    Route::put('/admin/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
