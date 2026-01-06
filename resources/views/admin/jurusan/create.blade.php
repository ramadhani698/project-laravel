@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4">Tambah Jurusan</h1>

    <!-- FLASH MESSAGE -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nama Jurusan -->
                <div class="mb-3">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Deskripsi Singkat -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="short_description" class="form-control" rows="3" required>{{ old('short_description') }}</textarea>
                </div>

                <!-- Tentang Jurusan -->
                <div class="mb-3">
                    <label class="form-label">Tentang Jurusan</label>
                    <textarea name="about" class="form-control" rows="5" required>{{ old('about') }}</textarea>
                </div>

                <!-- Urutan Tampil -->
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required>
                </div>

                <!-- Upload Gambar -->
                <div class="mb-3">
                    <label class="form-label">Gambar Jurusan</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Jurusan</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
