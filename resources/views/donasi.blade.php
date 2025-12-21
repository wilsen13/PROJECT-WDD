@extends('layouts.main')

@section('title', 'Donasi - SatuHati')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/donasi.css') }}">
@endpush

@section('content')
    <section class="donasi-hero">
        <div class="donasi-hero-overlay"></div>
        <div class="donasi-hero-content">
            <h1 class="donasi-hero-title">Kebaikan Anda, Harapan Mereka</h1>
            <p class="donasi-hero-subtitle">Setiap donasi membawa perubahan nyata. Pilih salah satu program di bawah ini dan jadilah bagian dari solusi.</p>
        </div>
    </section>

    <div class="donasi-container">
        <h2 class="donasi-section-heading">Kategori Donasi</h2>
        <div class="donasi-cards">
            @foreach($campaigns as $campaign)
                @php
                    $target = $campaign->TargetDana > 0 ? $campaign->TargetDana : 1; 
                    $persen = ($campaign->DanaTerkumpul / $target) * 100;
                    $lebarBar = $persen > 100 ? 100 : $persen;
                @endphp

                <div class="donasi-card" id="campaign-{{ $campaign->CampaignID }}">
                    <div class="donasi-card-image">
                        <span class="donasi-card-badge">
                            {{ $campaign->category->NamaKategoriCampaign ?? 'Umum' }}
                        </span>
                        <img src="{{ asset('image/' . $campaign->ImageURL) }}" alt="{{ $campaign->Judul }}"> 
                    </div>
                    <div class="donasi-card-body">
                        <h3 class="donasi-card-title">{{ $campaign->Judul }}</h3>
                        
                        <p class="donasi-card-description">
                            {{ Str::limit($campaign->Deskripsi, 100) }}
                        </p>
                        
                        <div class="donasi-progress-container">
                            <div class="donasi-progress-label">
                                <span>Progress Penggalangan Dana</span>
                                <span class="donasi-progress-percentage">{{ number_format($persen, 0) }}%</span>
                            </div>
                            <div class="donasi-progress-bar">
                                <div class="donasi-progress-fill" style="width: {{ $lebarBar }}%"></div>
                            </div>
                        </div>
                        
                        <div class="donasi-card-statistics">
                            <div class="donasi-stat-item">
                                <div class="donasi-stat-label">Dana Terkumpul</div>
                                <div class="donasi-stat-value">
                                    Rp {{ number_format($campaign->DanaTerkumpul, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="donasi-stat-item">
                                <div class="donasi-stat-label">Jumlah Donatur</div>
                                <div class="donasi-stat-value">
                                    {{ number_format($campaign->transactions_count) }} Donatur
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('donasi.payment', $campaign->CampaignID) }}" class="donasi-card-cta-btn">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection