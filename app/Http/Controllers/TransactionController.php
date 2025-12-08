<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // 1. FUNGSI SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'campaign_id'    => 'required', 
            'amount'         => 'required|numeric|min:10000',
            'payment_method' => 'required',
        ]);

        // Gunakan variabel ini untuk menangkap hasil transaksi dari dalam DB::transaction
        $result = DB::transaction(function () use ($request) {
            
            // Simpan Data
            $trx = Transaction::create([
                'user_id'           => Auth::id(),
                'CampaignID'        => $request->campaign_id,
                'Jumlah'            => $request->amount,      
                'StatusPembayaran'  => 'success', 
                'MetodePembayaran'  => $request->payment_method,
                'NamaDonatur'       => Auth::user()->full_name ?? Auth::user()->name,
                'EmailDonatur'      => Auth::user()->email,
            ]);

            // Update Saldo Campaign
            $campaign = Campaign::where('CampaignID', $request->campaign_id)->first();
            if($campaign) {
                $campaign->DanaTerkumpul += $request->amount; 
                $campaign->save();
            }

            // Kembalikan objek transaksi agar bisa dibaca di luar
            return $trx; 
        });

    
        return redirect()->route('success', $result->TransactionID);
    }

    // 2. FUNGSI TAMPILKAN HALAMAN SUKSES
    public function success($id)
    {
        // Cari data transaksi berdasarkan ID
        $transaction = Transaction::with('campaign')->findOrFail($id);

        // Validasi keamanan: Cek apakah yang akses adalah pemilik transaksi?
        if ($transaction->user_id != Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('success', compact('transaction'));
    }
}