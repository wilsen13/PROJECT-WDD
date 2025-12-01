@extends('layouts.main')
@section('title', 'Tentang Kami')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
@endpush

@section('content')
    <section class="about-us-pembuka">
        <h1>Tentang Kami</h1>
        <p class="lead">Jembatan kebaikan antara donatur dan penerima manfaat.</p>
        <p>Kami membantu Anda menyalurkan bantuan secara mudah, transparan, dan tepat sasaran.</p>
    </section>

    <section class="about-us-feature reveal fade-up">
        <h2 class="section-title">Bagaimana Anda Bisa Membantu?</h2>
        <div class="features-grid">
            <article class="feature-card">
                <div class="feature-icon"><i class="bi bi-box2-heart"></i></div>
                <h3 class="feature-title">Memberi Donasi</h3>
                <p class="feature-desc">Kontribusi Anda membantu meringankan beban saudara kita yang sedang kesulitan.</p>
            </article>
            <article class="featusre-card">
                <div class="feature-icon"><i class="bi bi-person-hearts"></i></div>
                <h3 class="feature-title">Sebarkan Kebaikan</h3>
                <p class="feature-desc">Jadilah bagian dari perubahan dengan membagikan informasi dan mengajak orang lain untuk berdonasi.</p>
            </article>
        </div>
    </section>

    <section class="visi-misi reveal fade-up">
        <h2 class="section-title">Visi & Misi</h2>
        <div class="vm-grid">
            <article class="vm-card">
                <div class="vm-icon"><i class="bi bi-globe-americas"></i></div>
                <h3 class="vm-title">Visi</h3>
                <p class="vm-desc">Menjadi wadah donasi terpercaya yang menghubungkan kebaikan banyak orang untuk kehidupan yang adil, sejahtera, dan penuh harapan.</p>
            </article>
            <article class="vm-card">
                <div class="vm-icon"><i class="bi bi-search-heart-fill"></i></div>
                <h3 class="vm-title">Misi</h3>
                <p class="vm-desc">Mewujudkan penyaluran dana yang transparan dan akuntabel dengan laporan berkala.</p>
            </article>
        </div>
    </section>

    <section class="foto-tim-section reveal fade-up">
        <div class="foto-tim-container">
            <div class="foto-tim-left">
                <div class="foto-frame">
                    <img src="{{ asset('image/foto tim.jpg') }}" alt="Foto Tim">
                </div>
            </div>
            <div class="foto-tim-right">
                <div class="foto-tim-caption">Tim kami terdiri dari individu yang berkomitmen pada transparansi dan kepedulian.</div>
            </div>
        </div>
    </section>

    <section class="achievements reveal fade-up">
        <h2 class="section-title">Pencapaian</h2>
        <div class="ach-grid">
            <article class="ach-card">
                <div class="ach-icon"><i class="bi bi-cash-stack"></i></div>
                <div class="ach-meta">
                    <div class="ach-label">Total Donasi Terkumpul</div>
                    <div class="ach-value"><span class="counter" data-target="145673264">0</span></div>
                </div>
            </article>
            <article class="ach-card">
                <div class="ach-icon"><i class="bi bi-suit-heart-fill"></i></div>
                <div class="ach-meta">
                    <div class="ach-label">Orang Terbantu</div>
                    <div class="ach-value"><span class="counter" data-target="56789">0</span></div>
                </div>
            </article>
            <article class="ach-card">
                <div class="ach-icon"><i class="bi bi-people-fill"></i></div>
                <div class="ach-meta">
                    <div class="ach-label">Jumlah Donatur</div>
                    <div class="ach-value"><span class="counter" data-target="20164">0</span></div>
                </div>
            </article>
        </div>
    </section>
@endsection