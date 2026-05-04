<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\User\ResepController as UserResepController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResepController as AdminResepController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\UlasanController;

Route::get('/', function () {
    return redirect()->route('login.user');
});

// Login, Register & Logout
Route::get('/login', [LoginController::class, 'showUserLogin'])->name('login.user');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.user.post');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name('login.admin.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [LoginController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'updatePassword'])->name('password.update');

// Halaman User (Login Required)
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [UserResepController::class, 'index'])->name('dashboard'); 
    Route::get('/resep/{id}', [UserResepController::class, 'detail'])->name('user.resep.detail');
    Route::post('/resep/{id}/ulasan', [UserResepController::class, 'kirimUlasan'])->name('user.ulasan.kirim');
    Route::post('/resep/{id}/bookmark', [UserResepController::class, 'toggleBookmark'])->name('user.bookmark');
    Route::get('/bookmark', [UserResepController::class, 'bookmark'])->name('user.bookmark.index');
});

// Halaman Admin & Superadmin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/resep', [AdminResepController::class, 'index'])->name('resep.index');
    Route::get('/resep/tambah', [AdminResepController::class, 'tambah'])->name('resep.tambah');
    Route::post('/resep', [AdminResepController::class, 'simpan'])->name('resep.simpan');
    Route::get('/resep/{id}/edit', [AdminResepController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [AdminResepController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [AdminResepController::class, 'hapus'])->name('resep.hapus');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'simpan'])->name('kategori.simpan');
    Route::delete('/kategori/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
    Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');

    //Khusus Superadmin
    Route::get('/permintaan-reset', [DashboardController::class, 'resetRequests'])->name('reset.requests');
    Route::post('/approve-reset/{id}', [LoginController::class, 'approveReset'])->name('approve.reset');
    Route::post('/reject-reset/{id}', [LoginController::class, 'rejectReset'])->name('reject.reset');
});