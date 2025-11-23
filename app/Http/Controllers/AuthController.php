<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- PENGGANTI REGISTER.PHP ---
    public function register(Request $request)
    {
        // 1. Validasi 
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users', 
            'no_telp' => 'required',
            'password' => 'required|min:6'
        ]);

        // 2. Simpan ke Database
        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'registration_date' => now(),
            // PENTING: Laravel pakai Bcrypt, bukan MD5. 
            // Nanti saya jelaskan di bawah.
            'password' => Hash::make($request->password) 
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }

    // --- PENGGANTI LOGIN.PHP ---
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Auth::attempt otomatis cek email & hash password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            
            return redirect()->intended('/'); // Ke homepage
        }

        // Kalau gagal
        return back()->with('error', 'Email atau password salah.');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
