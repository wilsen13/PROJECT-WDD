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
    // daftar campaign bisa di edit dan dihapus
    public function index()
    {
        $campaigns = Campaign::with('category')->orderBy('CampaignID', 'desc')->get();
        return view('admin.dashboard', compact('campaigns'));
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
            $file->move(public_path('image'), $filename);
            $path = $filename;
        }

        Campaign::create([
            'user_id' => Auth::id(), 
            'CategoryID' => $request->CategoryID,
            'Judul' => $request->Judul,
            'Deskripsi' => $request->Deskripsi,
            'TargetDana' => $request->TargetDana,
            'DanaTerkumpul' => 0, 
            'ImageURL' => $path,
        ]);

        return redirect()->back()->with('success', 'Program Donasi Berhasil Dibuat!');
    }

    // MENGHAPUS CAMPAIGN
    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $campaign->delete();

        return redirect()->back()->with('success', 'Program berhasil dihapus!');
    }
}