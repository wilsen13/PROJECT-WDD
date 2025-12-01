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
@endsection