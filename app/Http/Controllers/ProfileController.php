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
        
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('profile.edit', compact('user'));
    }

    //update data diri dan password
    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        
        // validate input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Email boleh sama kalau punya sendiri
            'no_telp' => 'required|string|max:20',
            'current_password' => 'nullable|required_with:new_password', // Wajib diisi kalau mau ganti password
            'new_password' => 'nullable|min:6|confirmed', // Harus ada konfirmasi (new_password_confirmation)
        ]);

        // // Cek Password Lama (Jika mau ganti password)
        // if ($request->filled('current_password')) {
        //     if (!Hash::check($request->current_password, $user->password)) {
        //         return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        //     }
        //     // Jika benar, update password baru
        //     $user->password = Hash::make($request->new_password);
        // }

        // update data 
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->save(); // Simpan ke database

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // upload foto profil
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            //ketentuan gambar profil
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_pic')) {
            // untuk menghapus foto lama
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // simpan foto ke folder yang ada 
            $path = $request->file('profile_pic')->store('profile-photos', 'public');
            
            // simpan path ke dalam database
            $user->profile_photo_path = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diubah!');
    }
}