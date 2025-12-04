<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController; 
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TransactionController; 


// --- HALAMAN PUBLIC (dapat diliat oleh user) ---
Route::get('/', function () { return view('index'); });
Route::get('/donasi', [DonationController::class, 'index'])->name('donasi.index');
Route::get('/news', function () { return view('news'); });
Route::get('/about', function () { return view('aboutus'); });
Route::get('/faq', function () { return view('faq'); });
Route::get('/contact', function () { return view('contact'); });

// --- HALAMAN AUTH (Login/Register) ---
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');

// --- PROSES LOGIC AUTH ---
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// --- PROSES DONASI (PENTING: Ini yang menghubungkan Form ke Database) ---
// Route::post('/donasi/process', [DonationController::class, 'process']); 


// --- GROUP ROUTE YANG WAJIB LOGIN ---
Route::middleware('auth')->group(function () {
    // Edit Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Proses Update Data Diri & Password
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Upload Foto Profil
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');

    // Logout khusus member (opsional jika ingin route bernama 'logout' di dalam auth)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Form Pembayaran (Setelah klik Donasi Sekarang)
    Route::get('/donasi/pay/{id}', [DonationController::class, 'showPayment'])->name('donasi.payment');
    
    // Proses Simpan Transaksi
    Route::post('/donasi/process', [TransactionController::class, 'store'])->name('transaction.store');
});


// --- GROUP ROUTE ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    // Campaign Management
    Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
});