@extends('layouts.main')

@section('title', 'Donasi Berhasil')

@section('content')
<div class="container py-5" style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card shadow-lg border-0 text-center p-4" style="max-width: 500px; width: 100%; border-radius: 20px;">
        
        <div class="card-body">
            <!-- Ikon Ceklis Besar -->
            <div class="mb-4">
                <div style="width: 80px; height: 80px; background: #d1e7dd; color: #198754; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="bi bi-check-lg" style="font-size: 3rem;"></i>
                </div>
            </div>

            <h2 class="fw-bold text-dark mb-1">Terima Kasih!</h2>
            <p class="text-muted mb-4">Donasi Anda telah kami terima.</p>

            <!-- Detail Transaksi (Struk) -->
            <div class="bg-light p-3 rounded-3 text-start mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">ID Transaksi</span>
                    <span class="fw-bold text-dark">#TRX-{{ $transaction->TransactionID }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Tanggal</span>
                    <span class="fw-bold text-dark">{{ date('d M Y, H:i', strtotime($transaction->TanggalTransaksi)) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Metode</span>
                    <span class="fw-bold text-dark text-uppercase">{{ str_replace('_', ' ', $transaction->MetodePembayaran) }}</span>
                </div>
                <hr style="border-color: #ddd;">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Total Donasi</span>
                    <span class="fw-bold text-success fs-4">Rp {{ number_format($transaction->Jumlah, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="small text-muted mb-4">
                Dana ini akan disalurkan untuk program:<br>
                <strong class="text-dark">{{ $transaction->campaign->Judul }}</strong>
            </p>

            <!-- Tombol Aksi -->
            <div class="d-grid gap-2">
                {{-- Kamu bisa arahkan ke halaman profil/riwayat jika sudah ada --}}
                {{-- <a href="{{ route('profile.history') }}" class="btn btn-outline-success">Lihat Riwayat Donasi</a> --}}
                
                <a href="{{ route('donasi.index') }}" class="btn btn-success fw-bold py-2">Donasi Lagi</a>
                <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-secondary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endsection