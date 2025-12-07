@extends('layouts.admin') 

@section('content')
<div class="container py-5">
    <h2>Tambah Program Donasi Baru</h2>
    
    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label>Judul Campaign</label>
            <input type="text" name="Judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori (ID)</label>
            <select name="CategoryID" class="form-control">
                <option value="1">Kesehatan</option>
                <option value="2">Pendidikan</option>
                <option value="3">Bencana</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Target Dana (Rp)</label>
            <input type="number" name="TargetDana" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Upload Foto</label>
            <input type="file" name="ImageURL" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Lengkap</label>
            <textarea name="Deskripsi" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Terbitkan Campaign</button>
    </form>
</div>

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h4 class="mb-0 font-weight-bold">Tambah Berita Video</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Berita</label>
                    <input type="text" name="Judul" class="form-control" placeholder="Contoh: Kegiatan Bakti Sosial di Desa A" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Link Video (YouTube)</label>
                    <input type="url" name="VideoURL" class="form-control" placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ" required>
                    <small class="text-muted">Copy dan paste link lengkap dari browser.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="Deskripsi" rows="6" class="form-control" placeholder="Tuliskan deskripsi lengkap berita di sini..." required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Publish Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





