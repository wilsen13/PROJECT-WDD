@extends('layouts.main')
@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
<main class="container mt-4">
    <form class="border p-4 rounded" action="{{ url('/login') }}" method="POST">
        @csrf
        <h2 class="mb-4">Login Akun</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <div class="form-group">
            <label for="emailInput">E-mail:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required />
        </div>
        <div class="form-group">
            <label for="passwordInput">Password :</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required/>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </form>
    
    <div class="text-center mt-3">
        <p class="register-link-text">
            Belum punya akun? <a href="{{ url('/register') }}" class="register-link">Daftar di sini</a>
        </p>
    </div>
</main>
@endsection