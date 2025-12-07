@extends('layouts.main')
@section('title', 'FAQ')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endpush

@section('content')
    <section class="hero-section">
        <h1>Pusat Bantuan</h1>
        <p>Temukan jawaban atas semua pertanyaan Anda di sini.</p>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Cari pertanyaan..." id="searchHeroInput">
            <div class="search-results" id="searchHeroResults"></div>
        </div>
    </section>

    <section class="faq-section">
        <div class="faq-category">
            <h2>Kategori Umum</h2>
            <div class="faq-item">
                <button class="faq-question">
                    <span>Apa ini platform donasi apa?</span>
                    <span class="icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Kami adalah platform non-profit yang menghubungkan donatur dengan program-program sosial yang terverifikasi.</p>
                </div>
            </div>
            </div>

        <div class="faq-category">
            <h2>Kategori Donasi & Pembayaran</h2>
            <div class="faq-item">
                <button class="faq-question">
                    <span>Bagaimana cara saya berdonasi?</span>
                    <span class="icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Anda dapat memilih program yang Anda minati, klik tombol 'Donasi Sekarang', isi nominal dan data diri.</p>
                </div>
            </div>
             </div>
    </section>

    <section class="cta-section">
        <h2>Masih Butuh Bantuan?</h2>
        <p>Jika Anda tidak menemukan jawaban yang Anda cari, jangan ragu untuk menghubungi tim support kami.</p>
        <a href="{{ url('/contact') }}" class="cta-button">Hubungi Kami</a>
    </section>

    @push('scripts')
        <script src="{{ asset('js/faq.js') }}"></script>
    @endpush
@endsection