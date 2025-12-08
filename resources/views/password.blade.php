@extends('layouts.main')
@section('title', 'Ganti Password')

@push('styles')
<style>
    .profile-body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; padding: 3rem 0; }
    .profile-container { max-width: 800px; margin: 0 auto; }
    .profile-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15); border: none; padding: 2rem; }
    
    .content-header h3 { font-size: 1.8rem; color: #2c3e50; margin-bottom: 0.5rem; font-weight: 700; }
    .content-header p { color: #7f8c8d; font-size: 0.95rem; margin-bottom: 2rem; }

    .form-label { font-weight: 600; color: #2c3e50; }
    .form-control { border-radius: 8px; padding: 0.75rem 1rem; border: 2px solid #e0e0e0; background-color: #f8f9fa; }
    .form-control:focus { border-color: #00a989; background-color: white; box-shadow: 0 0 0 3px rgba(0, 169, 137, 0.1); outline: none; }

    .btn-submit { background: linear-gradient(135deg, #00a989 0%, #00c2a3 100%); border: none; color: white; padding: 0.85rem 2rem; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 169, 137, 0.4); }
    
    .btn-back { color: #7f8c8d; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; margin-bottom: 1rem; }
    .btn-back:hover { color: #2c3e50; }
</style>
@endpush

@section('content')
<div class="profile-body">
    <div class="container profile-container">
        
        <a href="{{ route('profile.edit') }}" class="btn-back">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Edit Profil
        </a>

        <div class="card profile-card">
            <div class="content-header text-center">
                <h3>Ganti Password</h3>
                <p>Amankan akun Anda dengan password yang kuat</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="6">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-submit">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection