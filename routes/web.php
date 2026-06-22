<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;
 
// Group 1: Isolasi Keamanan Khusus untuk Pengunjung Tamu (Belum Login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.auth');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
});
 
// Group 2: Isolasi Keamanan Khusus untuk Pengguna yang Telah Sukses Terautentikasi
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/surat/{id}/cetak', [SuratController::class, 'cetakPdf'])->name('surat.cetak');

    Route::resource('surat', SuratController::class);
});
