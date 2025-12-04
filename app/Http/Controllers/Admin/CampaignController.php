<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\CategoryCampaign; // Pastikan model kategori ada
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    // MENAMPILKAN DAFTAR CAMPAIGN (Agar bisa diedit/hapus)
    public function index()
    {
        $campaigns = Campaign::with('category')->latest()->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        // Ambil kategori untuk dropdown
        $categories = CategoryCampaign::all();
        return view('admin.campaigns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Judul' => 'required|string|max:255',
            'CategoryID' => 'required|integer',
            'TargetDana' => 'required|numeric',
            'Deskripsi' => 'required',
            'ImageURL' => 'required|image|max:2048', 
        ]);

        $path = null;
        if ($request->hasFile('ImageURL')) {
            // Simpan gambar, ambil nama filenya saja untuk disimpan di DB
            $file = $request->file('ImageURL');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/image', $filename); // Simpan di storage/app/public/image
            $path = $filename;
        }

        Campaign::create([
            'user_id' => Auth::id(), 
            'CategoryID' => $request->CategoryID,
            'Judul' => $request->Judul,
            'Deskripsi' => $request->Deskripsi,
            'TargetDana' => $request->TargetDana,
            'DanaTerkumpul' => 0, 
            'ImageURL' => $path, // Simpan nama file saja
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Program Donasi Berhasil Dibuat!');
    }

    // MENGHAPUS CAMPAIGN
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        // Hapus gambar jika ada (Opsional)
        // Storage::delete('public/image/' . $campaign->ImageURL);

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->with('success', 'Program berhasil dihapus!');
    }
}