<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// --- ARAHKAN HALAMAN UTAMA KE DASHBOARD ---
Route::get('/', function () { 
    return redirect()->route('dashboard'); 
});

Route::get('/home', function () { 
    return redirect()->route('dashboard'); 
});

// --- AKSES PUBLIK (BELUM LOGIN) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- AKSES SISTEM (WAJIB LOGIN) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profil User
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Halaman Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Fitur PDF (Disinkronkan dengan controller agar tidak 404)
    Route::get('/loans/export-pdf', [LoanController::class, 'exportPDF'])->name('loans.pdf');
    Route::get('/loans/pdf', [LoanController::class, 'exportPDF']); // Backup route
    
    // CRUD Barang & Peminjaman
    Route::resource('items', ItemController::class);
    Route::resource('loans', LoanController::class);
    Route::patch('/loans/{id}/return', [LoanController::class, 'return'])->name('loans.return');
});