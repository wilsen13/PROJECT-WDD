<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        //mengurutkan berita dari yang paling baru
        $news = News::latest('created_at')->get();
        
        //untuk menampilkan di views public
        return view('news', compact('news'));
    }
}