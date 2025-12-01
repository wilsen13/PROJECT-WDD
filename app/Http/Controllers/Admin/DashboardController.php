<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Transaction; // Pastikan model Transaction sudah dibuat
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //membuat hitungan sederhana untuk menampilkan total user
        $totalUser = User::where('role', 'member')->count();
        $totalCampaign = Campaign::count();
        // menghitung semua total donasi yang ada (untuk dashboard admin)
        $totalDonasi = Transaction::sum('amount'); 
        
        return view('admin.dashboard', compact('totalUser', 'totalCampaign', 'totalDonasi'));
    }
}