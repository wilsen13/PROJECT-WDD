<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        // Ambil berita terbaru
        $news = News::latest('created_at')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'Judul'     => 'required|string|max:255',
            'Deskripsi' => 'required',
            'VideoURL'  => 'required|url', 
        ]);

        // 2. Simpan ke Database
        News::create([
            'user_id'   => Auth::id(),
            'Judul'     => $request->Judul,
            'Deskripsi' => $request->Deskripsi,
            'VideoURL'  => $request->VideoURL, 
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Berita Video berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus!');
    }
}