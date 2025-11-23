@extends('layouts.main')

@section('title', 'Home - SatuHati')

@section('content')
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <p class="eyebrow">Mulai Dari Sekarang.</p>
            <h1 class="hero-title">Ulurkan Tangan<br>Sebarkan Harapan.</h1>
            <p class="hero-subtitle">Karena Satu Donasi Bisa Merubah Hidup.</p>
            <div class="hero-actions">
                <a href="{{ url('/donasi') }}" class="btn-cta">Learn More</a>
            </div>
        </div>
    </section>

    <div class="container main-section">
        <h3 class="section-heading">Mengapa Harus Berdonasi?</h3>
        <div class="cards">
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Empati</span>
                    <img src="{{ asset('image/donation1.avif') }}" alt="Collecting Fund">
                </div>
                <div class="card-body">
                    <h3>Membantu Sesama Yang Membutuhkan</h3>
                    <p>Donasi menjadi bentuk kepedulian nyata untuk meringankan beban orang lain yang sedang kesulitan..</p>
                </div>
            </div>
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Aksi</span>
                    <img src="{{ asset('image/donation2.jpeg') }}" alt="Blood Camp">
                </div>
                <div class="card-body">
                    <h3>Menjadi Bagian dari Gerakan Kebaikan</h3>
                    <p>Donasi bukan hanya memberi, tetapi juga menginspirasi orang lain untuk ikut berbagi.</p>
                </div>
            </div>
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Dampak</span>
                    <img src="{{ asset('image/5913eadd2fff60e5f45c78cdd347f8eb.jpg') }}" alt="Friendly Volunteer">
                </div>
                <div class="card-body">
                    <h3>Dampak Kecil yang Bermakna Besar</h3>
                    <p>Walau jumlahnya sedikit, donasi yang terkumpul dapat memberikan perubahan besar bagi penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <section class="video-section">
        <div class="video-container">
            <div class="video-left">
                <div class="video-frame">
                    <iframe src="https://www.youtube-nocookie.com/embed/wUbR69tvKxg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
            <div class="video-right">
                <div class="video-side-caption">Kebaikan kecil hari ini, menjadi harapan besar esok. Terima kasih telah mendukung misi kami.</div>
            </div>
        </div>
    </section>

    <div class="container main-section">
        <h3 class="section-heading">Kategori Donasi</h3>
        <div class="cards">
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Pendidikan</span>
                    <img src="{{ asset('image/Gambar_anak5.jpg') }}" alt="Collecting Fund">
                </div>
                <div class="card-body">
                    <h3>Pendidikan Untuk Anak Kurang Mampu</h3>
                    <p>Bantu anak-anak kurang mampu mendapatkan akses pendidikan yang layak, agar mereka bisa meraih masa depan yang lebih baik.</p>
                </div>
            </div>
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Kesehatan</span>
                    <img src="{{ asset('image/Gambar_anak1.jpeg') }}" alt="Blood Camp">
                </div>
                <div class="card-body">
                    <h3>Bantuan Kesehatan Dan Pengobatan</h3>
                    <p>Donasi Anda dapat membantu menyediakan layanan kesehatan, obat-obatan, hingga perawatan darurat bagi mereka yang membutuhkan.</p>
                </div>
            </div>
            <div class="card">
                <div class="image-wrap">
                    <span class="image-badge">Pangan</span>
                    <img src="{{ asset('image/gambar_anak3.jpeg') }}" alt="Friendly Volunteer">
                </div>
                <div class="card-body">
                    <h3>Pangan Dan Kebutuhan Pokok</h3>
                    <p>Sumbangan Anda bisa menjadi harapan bagi keluarga yang kesulitan memenuhi kebutuhan dasar sehari-hari seperti makanan dan pakaian</p>
                </div>
            </div>
        </div>
    </div>
          
    <section class="cta-section">
        <div class="cta-wrap">
            <h3 class="cta-heading">Siap jadi bagian dari kebaikan?</h3>
            <p class="cta-sub">Satu klik Anda dapat membantu pendidikan, kesehatan, dan kebutuhan pokok mereka yang membutuhkan.</p>
            <a href="{{ url('/donasi') }}" class="btn-cta cta-btn">Donasi Sekarang!</a>
        </div>
    </section>
@endsection