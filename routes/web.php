<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- Halaman Public ---
Route::get('/', function () { return view('index'); });
Route::get('/donasi', function () { return view('donasi'); });
Route::get('/news', function () { return view('news'); });
Route::get('/about', function () { return view('aboutus'); });
Route::get('/faq', function () { return view('faq'); });
Route::get('/contact', function () { return view('contact'); });

// --- Halaman Auth ---
// Tampilan Login/Register
Route::get('/login', function () { return view('login'); })->name('login');
Route::get('/register', function () { return view('register'); });

// Proses Logic (Ke Controller)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Placeholder untuk proses donasi (nanti dibuat controllernya)
Route::post('/donasi/process', function() {
    return "Proses donasi akan dibuat di DonationController";
});