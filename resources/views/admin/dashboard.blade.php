@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-bold text-dark">Dashboard Admin</h2>

    <!-- 1. KARTU STATISTIK -->
    <div class="row g-4 mb-5">
        <!-- Total Donasi -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Total Donasi Masuk</h6>
                        <h2 class="mb-0 fw-bold">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h2>
                    </div>
                    <div class="fs-1 opacity-50"><i class="bi bi-wallet2"></i></div>
                </div>
            </div>
        </div>

        <!-- Program Aktif -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Program Aktif</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalCampaign }} Program</h2>
                    </div>
                    <div class="fs-1 opacity-50"><i class="bi bi-megaphone"></i></div>
                </div>
            </div>
        </div>

        <!-- Total Donatur -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Total User Member</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUser }} Orang</h2>
                    </div>
                    <div class="fs-1 opacity-50"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <!-- 2. TABEL TRANSAKSI TERBARU (Kiri/Atas) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-dark">Transaksi Donasi Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Donatur</th>
                                    <th>Campaign</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTransactions as $t)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $t->NamaDonatur ?? 'Anonim' }}</div>
                                        <small class="text-muted">{{ $t->EmailDonatur }}</small>
                                    </td>
                                    <td>
                                        <!-- Menampilkan Judul Campaign (Dibatasi agar tidak panjang) -->
                                        {{ Str::limit($t->campaign->Judul ?? 'Campaign Dihapus', 30) }}
                                    </td>
                                    <td class="fw-bold text-success">
                                        Rp {{ number_format($t->Jumlah, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $t->StatusPembayaran }}</span>
                                    </td>
                                    <td>
                                        <small>{{ $t->TanggalTransaksi }}</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada transaksi masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. KELOLA CAMPAIGN (Kanan/Bawah) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">Program Donasi</h5>
                    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-sm btn-primary">+ Tambah</a>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($campaigns as $c)
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset('image/' . $c->ImageURL) }}" width="40" height="40" class="rounded object-fit-cover">
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Str::limit($c->Judul, 20) }}</div>
                                    <small class="text-muted">Rp {{ number_format($c->DanaTerkumpul, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <form action="{{ route('admin.campaigns.destroy', $c->CampaignID) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                        @empty
                        <div class="p-3 text-center text-muted">Belum ada program.</div>
                        @endforelse
                    </div>
                    @if($campaigns->count() >= 5)
                        <div class="p-2 text-center">
                            <a href="{{ route('admin.campaigns.index') }}" class="text-decoration-none small">Lihat Semua Campaign &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

 
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">Berita & Video Terbaru</h5>
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus-circle"></i> Tulis Berita
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Berita</th>
                            <th>Link Video</th>
                            <th>Deskripsi Singkat</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $n)
                        <tr>
                            <td class="fw-bold">{{ $n->Judul }}</td>
                            <td>
                                <a href="{{ $n->VideoURL }}" target="_blank" class="text-decoration-none text-danger">
                                    <i class="bi bi-youtube"></i> Tonton
                                    
                                </a>
                            </td>
                            <td>{{ Str::limit($n->Deskripsi, 50) }}</td>
                            <td>
                                <form action="{{ route('admin.news.destroy', $n->newsID) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada berita dipublish.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection