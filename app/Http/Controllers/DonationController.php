<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function donate(Request $request)
{
    // Ambil data session lama, default 0
    $count = session('donation_count', 0);
    $total = session('total_donation', 0);

    // Update logika
    $count++;
    $total += 50000;

    // Simpan balik ke session
    session(['donation_count' => $count]);
    session(['total_donation' => $total]);

    // Logika Hadiah (Bisa dikirim ke View)
    $message = "Terima kasih donasi ke-$count";
    if ($count == 1) {
        $message = "Selamat! Donasi pertama dapat Tiket Umroh!";
    }

    return back()->with('message', $message);
}
}
