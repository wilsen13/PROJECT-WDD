@extends('layouts.main')
@section('title', 'Berita')

@section('content')
    <section class="news-hero">
        <div class="news-hero-inner">
            <p class="news-eyebrow">Update & Insight</p>
            <h1 class="news-page-title">Berita Terbaru</h1>
            <p class="news-page-subtitle">Rangkuman cerita, laporan, dan video pilihan terkait aksi kemanusiaan.</p>
        </div>
    </section>

    <div class="news-container">
        <h2 class="news-section-heading">Sorotan Minggu Ini</h2>
        <article class="news-card">
            <div class="news-media">
                <div class="news-iframe-wrap">
                    <iframe class="news-iframe" src="https://www.youtube-nocookie.com/embed/eOUDg62KtfM" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="news-content">
                <h2 class="news-title">Banjir Bandang di Bali: Kisah Warga Bertahan Hidup</h2>
                <p class="news-desc">MetroTV, Banjir bandang di Bali merenggut 17 nyawa. Namun, di balik duka mendalam itu, muncul kisah haru perjuangan warga.</p>
            </div>
        </article>

        <article class="news-card">
            <div class="news-media">
                <div class="news-iframe-wrap">
                    <iframe class="news-iframe" src="https://www.youtube-nocookie.com/embed/MMk-6jT7Rh0" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="news-content">
                <h2 class="news-title">Kisah Inspiratif: Perjuangan Keluarga Miskin</h2>
                <p class="news-desc">Sebuah dokumentasi menyentuh tentang perjuangan keluarga yang hidup dalam keterbatasan ekonomi.</p>
            </div>
        </article>
        
        </div>
@endsection