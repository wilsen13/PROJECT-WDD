<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class DonationController extends Controller
{
    public function index()
    {
        // Ambil semua campaign beserta info kategorinya
        $campaigns = Campaign::with('category')->get();
        
        return view('donasi', compact('campaigns'));
    }
    
    // Function untuk menampilkan detail pembayaran (Langkah selanjutnya)
    public function showPayment($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('payment', compact('campaign'));
    }
}