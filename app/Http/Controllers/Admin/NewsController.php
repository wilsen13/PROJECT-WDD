<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // list berita 
    public function index()
    {
        $news = News::latest('created_at')->get();
        return view('admin.dashboard', compact('news'));
    }

    // halaman tambah form admin
    public function create()
    {
        return view('admin.campaigns.create');
    }

    // buat simpan ke database
    public function store(Request $request)
    {
        $request->validate([
            'Judul'     => 'required|string|max:255',
            'Deskripsi' => 'required',
            'VideoURL'  => 'required|url', // Wajib format Link
        ]);

        News::create([
            'user_id'   => Auth::id(),
            'Judul'     => $request->Judul,
            'Deskripsi' => $request->Deskripsi,
            'VideoURL'  => $request->VideoURL,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil diterbitkan!');
    }

    // untuk menghapus berita
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Berita dihapus!');
    }
}