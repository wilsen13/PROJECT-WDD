@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Overview</h2>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-stat bg-primary text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Donasi Masuk</h6>
                        <h2 class="mb-0 fw-bold">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</h2>
                    </div>
                    <div class="fs-1"><i class="bi bi-wallet2"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat bg-success text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Program Aktif</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalCampaign }} Program</h2>
                    </div>
                    <div class="fs-1"><i class="bi bi-megaphone"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat bg-warning text-dark p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Donatur</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUser }} Orang</h2>
                    </div>
                    <div class="fs-1"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Transaksi Terbaru</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Donatur</th>
                            <th>Campaign</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data transaksi terbaru.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection