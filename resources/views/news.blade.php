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

        {{-- MULAI LOOPING DATA DARI DATABASE --}}
        @forelse($news as $item)
            
            {{-- LOGIKA PHP: Ubah Link YouTube biasa jadi Link Embed --}}
            @php
                $videoUrl = $item->VideoURL;
                if (str_contains($videoUrl, 'watch?v=')) {
                    // Ubah 'watch?v=' menjadi 'embed/'
                    $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                    // Bersihkan parameter tambahan (seperti timestamp)
                    $parts = explode('&', $videoUrl);
                    $videoUrl = $parts[0];
                } elseif (str_contains($videoUrl, 'youtu.be/')) {
                    // Ubah link pendek 'youtu.be/' menjadi 'embed/'
                    $videoUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $videoUrl);
                }
            @endphp

            <article class="news-card">
                <div class="news-media">
                    <div class="news-iframe-wrap">
                        {{-- Masukkan Link yang sudah dikonversi ke sini --}}
                        <iframe class="news-iframe" 
                                src="{{ $videoUrl }}" 
                                title="{{ $item->Judul }}" 
                                frameborder="0" 
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="news-content">
                    {{-- Judul dari Database --}}
                    <h2 class="news-title">{{ $item->Judul }}</h2>
                    {{-- Deskripsi dari Database --}}
                    <p class="news-desc">{{ Str::limit($item->Deskripsi, 200) }}</p>
                </div>
            </article>

        @empty
            {{-- Tampilan jika belum ada berita sama sekali --}}
            <div style="text-align: center; padding: 40px; color: gray;">
                <p>Belum ada berita yang diterbitkan.</p>
            </div>
        @endforelse
        {{-- AKHIR LOOPING --}}
        
    </div>
@endsection