<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
   
    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'Judul' => 'required|string|max:255',
            'CategoryID' => 'required|integer', // Harusnya ambil dari tabel kategori
            'TargetDana' => 'required|numeric',
            'Deskripsi' => 'required',
            'ImageURL' => 'required|image|max:2048', 
        ]);

        // Proses Upload Gambar
        $path = null;
        if ($request->hasFile('ImageURL')) {
            $path = $request->file('ImageURL')->store('campaign-images', 'public');
        }

        // Simpan Data
        Campaign::create([
            'user_id' => Auth::id(), 
            'CategoryID' => $request->CategoryID,
            'Judul' => $request->Judul,
            'Deskripsi' => $request->Deskripsi,
            'TargetDana' => $request->TargetDana,
            'DanaTerkumpul' => 0, 
            'ImageURL' => $path,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Program Donasi Berhasil Dibuat!');
    }
}