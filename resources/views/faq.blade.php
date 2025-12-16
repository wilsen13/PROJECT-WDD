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
                    <span>Apa itu platform SatuHati?</span>
                    <span class="icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>SatuHati adalah wadah galang dana online (crowdfunding) untuk mempertemukan orang baik dengan mereka yang membutuhkan bantuan, mulai dari bantuan medis, bencana alam, pendidikan, hingga program sosial kemanusiaan lainnya.</p>
                </div>

                <button class="faq-question">
                <span>Siapa saja yang bisa menggalang dana di sini?</span>
                    <span class="icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Siapa saja bisa! Baik individu, komunitas, organisasi, hingga yayasan resmi, selama lolos proses verifikasi data dan memiliki tujuan sosial yang jelas serta dapat dipertanggungjawabkan.</p>
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

                <button class="faq-question">
                    <span>Apakah ada biaya administrasi saat berdonasi?</span>
                    <span class="icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Kami mengenakan biaya operasional sebesar 5% dari total donasi terkumpul untuk pemeliharaan sistem, server, dan verifikasi tim di lapangan. (Khusus kategori Bencana Alam biasanya 0%).</p>
                </div>
            </div>
             </div>
    </section>

    <section class="cta-section">
        <h2>Masih Butuh Bantuan?</h2>
        <p>Jika Anda tidak menemukan jawaban yang Anda cari, jangan ragu untuk menghubungi tim support kami.</p>
        <a href="https://wa.me/6281234567890" target="blank" class="cta-button"> <i class="bi bi-whatsapp"></i>Hubungi Kami</a>
    </section>

    @push('scripts')
        <script src="{{ asset('js/faq.js') }}"></script>
    @endpush
@endsection