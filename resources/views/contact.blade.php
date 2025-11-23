@extends('layouts.main')
@section('title', 'Kontak Kami')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
    <section class="contact-hero reveal">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu pertanyaan dan masukan Anda.</p>
    </section>

    <section class="contact-wrap reveal">
        <div class="contact-left">
            <h2>Kirim Pesan</h2>
            <form id="contactForm" class="contact-form">
                <label>Nama Lengkap</label>
                <input type="text" id="cName" placeholder="Masukkan nama" required>

                <label>Email</label>
                <input type="email" id="cEmail" placeholder="nama@contoh.com" required>

                <label>Subjek</label>
                <input type="text" id="cSubject" placeholder="Subjek pesan" required>

                <label>Pesan</label>
                <textarea id="cMessage" rows="5" placeholder="Tulis pesan Anda..." required></textarea>

                <button type="submit" class="btn-send">Kirim</button>
            </form>
            <div class="contact-hint">Atau hubungi via WhatsApp: <a href="https://wa.me/6281234567890" target="_blank">+62 812345678</a></div>
        </div>
        <div class="contact-right">
            <div class="info-card">
                <div class="info-item"><i class="bi bi-envelope"></i> info@satuhati.org</div>
                <div class="info-item"><i class="bi bi-telephone"></i> +62 812345678</div>
                <div class="info-item"><i class="bi bi-geo-alt"></i> Tangerang, Indonesia</div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(e){
        e.preventDefault();
        var name = document.getElementById('cName').value.trim();
        var email = document.getElementById('cEmail').value.trim();
        var subject = document.getElementById('cSubject').value.trim();
        var message = document.getElementById('cMessage').value.trim();
        var mailto = 'mailto:info@satuhati.org?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent('Nama: ' + name + '\nEmail: ' + email + '\n\n' + message);
        window.location.href = mailto;
    });
    </script>
    @endpush
@endsection