@extends('layouts.main')
@section('title', 'Edit Profil')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .profile-body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 3rem 0;
    }

    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .profile-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 0;
    }


    .profile-sidebar {
        background: linear-gradient(135deg, #00a989 0%, #00c2a3 100%);
        padding: 3rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .profile-sidebar::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-sidebar::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .profile-avatar-wrapper {
        position: relative;
        z-index: 2;
        margin-bottom: 2rem;
    }

    .profile-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.9);
        object-fit: cover;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        border-color: white;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }

    .profile-avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }

    .avatar-overlay i {
        font-size: 2.5rem;
    }

    .profile-user-info {
        position: relative;
        z-index: 2;
    }

    .profile-user-info h4 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .profile-user-info p {
        font-size: 0.95rem;
        opacity: 0.95;
        margin-bottom: 1.5rem;
    }

    .profile-hint {
        font-size: 0.85rem;
        opacity: 0.8;
        font-style: italic;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* konten profil */
    .profile-content {
        padding: 3rem;
        display: flex;
        flex-direction: column;
    }

    .content-header {
        margin-bottom: 2rem;
    }

    .content-header h3 {
        font-size: 1.8rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .content-header p {
        color: #7f8c8d;
        font-size: 0.95rem;
    }

    /* TABS */
    .nav-tabs {
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 2rem;
        gap: 2rem;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #7f8c8d;
        font-weight: 600;
        font-size: 0.95rem;
        padding: 0.75rem 0;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-tabs .nav-link:hover {
        color: #00a989;
    }

    .nav-tabs .nav-link.active {
        color: #00a989;
        border-bottom-color: #00a989;
    }

    /* FORM */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        outline: none;
        border-color: #00a989;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(0, 169, 137, 0.1);
    }

    .form-control::placeholder {
        color: #bdc3c7;
    }

    /* window alert */
    .alert {
        border-radius: 10px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        border: none;
        font-size: 0.95rem;
    }

    .alert-success {
        background-color: #d5f4e6;
        color: #00a989;
    }

    .alert-danger {
        background-color: #fadbd8;
        color: #c0392b;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    /* button */
    .btn-submit-profile {
        background: linear-gradient(135deg, #00a989 0%, #00c2a3 100%);
        border: none;
        color: white;
        padding: 0.85rem 2.5rem;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        margin-top: 1.5rem;
        width: fit-content;
        box-shadow: 0 4px 15px rgba(0, 169, 137, 0.3);
    }

    .btn-submit-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 169, 137, 0.4);
    }

    .btn-submit-profile:active {
        transform: translateY(0);
    }

    /* HIDDEN INPUT */
    #profile_pic_input {
        display: none;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .profile-sidebar {
            padding: 2rem;
            border-radius: 20px 20px 0 0;
        }

        .profile-content {
            padding: 2rem;
            border-radius: 0 0 20px 20px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
        }

        .profile-user-info h4 {
            font-size: 1.5rem;
        }

        .content-header h3 {
            font-size: 1.5rem;
        }

        .nav-tabs {
            gap: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-body">
    <div class="container profile-container">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card profile-card">
                <div class="profile-grid">
                    <!-- BAGIAN SIDEBAR -->
                    <div class="profile-sidebar">
                        <div class="profile-avatar-wrapper" onclick="document.getElementById('profile_pic_input').click();">
                            <img id="profile-preview" 
                                 src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://via.placeholder.com/160?text=Profile' }}" 
                                 alt="Profile Picture" 
                                 class="profile-avatar">
                            <div class="avatar-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>

                        <div class="profile-user-info">
                            <h4>{{ $user->full_name }}</h4>
                            <p>{{ $user->email }}</p>
                            <p class="profile-hint">Klik foto untuk mengganti</p>
                        </div>
                    </div>

                    <!-- BAGIAN konten -->
                    <div class="profile-content">
                        <div class="content-header">
                            <h3>Pengaturan Akun</h3>
                            <p>Kelola informasi profil Anda dengan aman</p>
                        </div>

                        <!-- UNTUK HIDDEN INPUT -->
                        <input type="file" name="profile_pic" id="profile_pic_input" onchange="previewImage(event);" accept="image/*">

                        <!-- BAGIAN ALERTS (window) -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                <strong>✓ Berhasil!</strong> {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>✕ Terjadi Kesalahan:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- bagian tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                                    Informasi Profil
                                </button>
                            </li>
                        </ul>

                        <!-- konten tab -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <div class="form-group">
                                    <label class="form-label">👤 Nama Lengkap</label>
                                    <input type="text" 
                                           name="full_name" 
                                           class="form-control" 
                                           value="{{ old('full_name', $user->full_name) }}" 
                                           required 
                                           placeholder="Masukkan nama lengkap Anda">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">📧 Email</label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control" 
                                           value="{{ old('email', $user->email) }}" 
                                           required 
                                           placeholder="Masukkan email Anda">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">📱 No. Telepon</label>
                                    <input type="text" 
                                           name="no_telp" 
                                           class="form-control" 
                                           value="{{ old('no_telp', $user->no_telp) }}" 
                                           placeholder="Contoh: 08123456789">
                                </div>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-submit-profile">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profile-preview').src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush