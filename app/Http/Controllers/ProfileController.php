<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function uploadPhoto(Request $request)
{
    // 1. Validasi 
    $request->validate([
        'profile_pic' => 'required|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    // File akan masuk ke storage/app/public/photos
    if ($request->hasFile('profile_pic')) {
        $path = $request->file('profile_pic')->store('photos', 'public');
        
    }

    return back()->with('success', 'Foto berhasil diupload');
}
}
