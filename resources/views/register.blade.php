@extends('layouts.main')
@section('title', 'Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<main class="container mt-4">
    <form class="border p-4 rounded" action="{{ url('/register') }}" method="POST">
        @csrf
        <h2 class="mb-4">Daftar Akun Baru</h2>
        
        <div class="form-group">
            <label>Nama Lengkap :</label>
            <input type="text" class="form-control" name="full_name" required />
        </div>
        
        <div class="form-group">
            <label>E-mail :</label>
            <input type="email" class="form-control" name="email" required />
        </div>
        
        <div class="form-group">
            <label>Password :</label>
            <input type="password" class="form-control" name="password" required />
        </div>

        <div class="form-group">
            <label>Konfirmasi Password :</label>
            <input type="password" class="form-control" name="password_confirmation" required />
        </div>
        
        <div class="form-group">
            <label>Nomor Telepon :</label>
            <input type="tel" class="form-control" name="no_telp" required />
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>
    
    <div class="text-center mt-3">
        <p class="register-link-text">
            Sudah punya akun? <a href="{{ url('/login') }}" class="register-link">Login di sini</a>
        </p>
    </div>
</main>
@endsection