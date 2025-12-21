<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // fungsi simpan
    public function store(Request $request)
    {
        $request->validate([
            'campaign_id'    => 'required', 
            'amount'         => 'required|numeric|min:10000',
            'payment_method' => 'required',
        ]);

        $result = DB::transaction(function () use ($request) {
            
            // simpan data ke databsae
            $trx = Transaction::create([
                'user_id'           => Auth::id(),
                'CampaignID'        => $request->campaign_id,
                'Jumlah'            => $request->amount,      
                'StatusPembayaran'  => 'success', 
                'MetodePembayaran'  => $request->payment_method,
                'NamaDonatur'       => Auth::user()->full_name ?? Auth::user()->name,
                'EmailDonatur'      => Auth::user()->email,
            ]);

            // mengupdate saldo campaign
            $campaign = Campaign::where('CampaignID', $request->campaign_id)->first();
            if($campaign) {
                $campaign->DanaTerkumpul += $request->amount; 
                $campaign->save();
            }

    
            return $trx; 
        });

    
        return redirect()->route('success', $result->TransactionID);
    }

    // halaman setelah berhasil melakukan pembayaran
    public function success($id)
    {
        //  mencari transaksi berdasarkan id
        $transaction = Transaction::with('campaign')->findOrFail($id);

        if ($transaction->user_id != Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('success', compact('transaction'));
    }
}