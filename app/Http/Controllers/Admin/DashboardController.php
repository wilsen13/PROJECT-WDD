<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Transaction; 
use App\Models\News; // Jangan lupa import Model News
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    
        $totalUser = User::where('role', 'member')->count();
        $totalCampaign = Campaign::count();
        
        
        $totalDonasi = Transaction::sum('Jumlah'); 
        
        
        $recentTransactions = Transaction::with(['users', 'campaign'])
                                ->latest('TanggalTransaksi') // Urutkan dari yg terbaru
                                ->take(5)
                                ->get();

        $campaigns = Campaign::latest()->take(5)->get();

       
        $news = News::latest('created_at')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUser', 
            'totalCampaign', 
            'totalDonasi', 
            'recentTransactions', 
            'campaigns', 
            'news'
        ));
    }
}