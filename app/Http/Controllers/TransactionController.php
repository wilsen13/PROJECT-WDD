<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
       
        $request->validate([
            'campaign_id'    => 'required|exists:campaign,CampaignID', // Pastikan nama tabel campaign pakai 's' atau tidak di DB mu (sesuaikan)
            'amount'         => 'required|numeric|min:10000',
            'payment_method' => 'required',
        ]);

        // Gunakan DB Transaction agar data konsisten
        DB::transaction(function () use ($request) {
            
            Transaction::create([
                'user_id'           => Auth::id(),
                'CampaignID'        => $request->campaign_id, 
                'Jumlah'            => $request->amount,      
                'StatusPembayaran'  => 'success', 
                'MetodePembayaran'  => $request->payment_method,

                'NamaDonatur'       => Auth::user()->full_name,
                'EmailDonatur'      => Auth::user()->email,
            ]);

            
            $campaign = Campaign::where('CampaignID', $request->campaign_id)->firstOrFail();
            
           
            $campaign->DanaTerkumpul += $request->amount; 
            $campaign->save();
        });

    
        return redirect()->route('donasi.index')->with('success', 'Terima kasih! Donasi Anda berhasil dicatat.');
    }
}