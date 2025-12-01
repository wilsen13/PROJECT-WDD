<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function donate(Request $request)
{

    $count = session('donation_count', 0);
    $total = session('total_donation', 0);

    $count++;
    $total += 50000;


    session(['donation_count' => $count]);
    session(['total_donation' => $total]);

    $message = "Terima kasih donasi ke-$count";
    if ($count == 1) {
        $message = "Selamat! Donasi pertama dapat Tiket Umroh!";
    }

    return back()->with('message', $message);
}
}
