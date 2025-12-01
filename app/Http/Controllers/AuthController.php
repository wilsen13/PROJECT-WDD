<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //bagian validasi
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users', 
            'no_telp' => 'required',
            'password' => 'required|min:6'
        ]);

     //untuk menyimpan kedatabase
        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            // 'registration_date' => now(),
            'password' => Hash::make($request->password) 
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // buat cek email dan password (validasi)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            
            return redirect()->intended('/'); // Ke homepage
        }

        // kalau gagal
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
