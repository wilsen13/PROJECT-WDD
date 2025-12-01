<?php
use App\Http\Controllers\Admin\CampaignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// halaman public (dilihat oleh user)
Route::get('/', function () { return view('index'); });
Route::get('/donasi', function () { return view('donasi'); });
Route::get('/news', function () { return view('news'); });
Route::get('/about', function () { return view('aboutus'); });
Route::get('/faq', function () { return view('faq'); });
Route::get('/contact', function () { return view('contact'); });

// halaman authorize (login/register)
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');

// Proses Logic (Ke Controller saat melakukan login)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\ProfileController; // <-- Jangan lupa ini di paling atas

// Grup Route yang Wajib Login
Route::middleware('auth')->group(function () {
    // edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // // Proses Update Data Diri & Password

    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    //buat profil
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');

    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//proses donasi
Route::post('/donasi/process', function() {
    return "Proses donasi akan dibuat di DonationController";
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard 
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');

    Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');

   
});