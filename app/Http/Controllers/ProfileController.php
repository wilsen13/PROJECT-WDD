<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // FUNGSI UPDATE (GABUNGAN DATA DIRI + FOTO)
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // 1. Validasi
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'no_telp' => 'required|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi Foto
        ]);

        // 2. Update Password (Jika ada)
        if ($request->filled('current_password')) {
             if (!Hash::check($request->current_password, $user->password)) {
                 return back()->withErrors(['current_password' => 'Password saat ini salah.']);
             }
             $user->password = Hash::make($request->new_password);
        }

        // 3. Update Data Teks
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;

        // cek: Apakah user upload file 'profile_pic'?
        if ($request->hasFile('profile_pic')) {
            
            // Hapus foto lama biar server gak penuh
            if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
                Storage::delete('public/' . $user->profile_photo_path);
            }

           
            $path = $request->file('profile_pic')->store('profile-photos', 'public');
            
       
            $user->profile_photo_path = $path;
        }

       
        $user->save(); 

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

     public function editPassword()
    {
        return view('password');
    }

    // Proses Ganti Password 
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed', 
        ]);

        $user = User::find(Auth::id());

        //untuk cek apakah pw lama benar?
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        // Update password baru
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diganti!');
    }
}

