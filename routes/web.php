<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanBaruController;
use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EnsureAdmin;

// Route halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route untuk registrasi pengguna
Route::get('/daftar', [DaftarController::class, 'daftarForm'])->name('daftar.form');
Route::post('/daftar', [DaftarController::class, 'register'])->name('daftar');

// Route untuk dashboard admin, dengan middleware untuk memastikan hanya admin yang bisa mengakses
Route::get('/admin', [AdminController::class, 'index'])->middleware(EnsureAdmin::class);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');