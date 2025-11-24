@extends('layouts.main')
@section('title', 'Edit Profil')

@push('styles')
<style>
    /* CSS Khusus Halaman Profil (Agar rapi dan senada) */
    .profile-section {
        padding: 60px 0;
        background-color: #f8f9fa; /* Latar belakang abu muda */
    }
    .profile-card {
        border: none;
        border-radius: 15px; /* Sudut membulat */
        box-shadow: 0 5px 20px rgba(0,0,0,0.08); /* Bayangan halus */
        overflow: hidden;
    }
    .profile-header {
        background-color: #00a989; /* Warna hijau SatuHati */
        color: white;
        padding: 30px;
        text-align: center;
    }
    .profile-img-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Agar foto tidak gepeng */
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    /* Tombol kamera kecil untuk upload */
    .profile-img-upload-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: white;
        color: #00a989;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .profile-img-upload-btn:hover {
        background-color: #f1f1f1;
        transform: scale(1.05);
    }
    .nav-pills .nav-link.active {
        background-color: #00a989; /* Warna aktif tab */
    }
    .nav-pills .nav-link {
        color: #2c3e50;
        font-weight: 500;
    }
    .form-control:focus {
        border-color: #00a989; /* Warna fokus input */
        box-shadow: 0 0 0 0.2rem rgba(0, 169, 137, 0.25);
    }
    .btn-success-custom {
        background-color: #00a989;
        border-color: #00a989;
        color: white;
        padding: 10px 25px;
        font-weight: 600;
    }
    .btn-success-custom:hover {
        background-color: #008f73;
        border-color: #008f73;
    }
</style>
@endpush

@extends('layouts.main')
@section('title', 'Edit Profil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Edit Profil Saya</h4>
                </div>
                <div class="card-body p-4">
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4 text-center">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover; border: 3px solid #ddd;">
                            @else
                                <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 24px;">
                                    {{ substr($user->full_name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <label for="photo" class="form-label small text-muted">Ganti Foto Profil</label>
                                <input type="file" name="profile_pic" class="form-control form-control-sm w-50 mx-auto">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}" required>
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3 text-muted">Ganti Password (Opsional)</h5>
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ulangi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection