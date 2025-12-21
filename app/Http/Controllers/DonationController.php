<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class DonationController extends Controller
{
    public function index()
    {
   
        $campaigns = Campaign::with('category') ->withCount('transactions') ->get();
        
        return view('donasi', compact('campaigns'));
    }
    

    public function showPayment($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('payment', compact('campaign'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([]);
        }

        $campaigns = Campaign::with('category')
                             ->where('Judul', 'LIKE', "%{$query}%")
                             ->orderBy('CampaignID', 'desc')
                             ->take(5) 
                             ->get();

        return response()->json($campaigns);
    }
}