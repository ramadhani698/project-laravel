@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Kata Kepala Sekolah</h5>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.principal-message.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Header</label>
                <input type="file" name="header_image" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Kepala Sekolah</label>
                <input type="file" name="photo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Salam Pembuka</label>
                <input type="text" name="greeting" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Pesan</label>
                <textarea name="content" rows="5" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="position" class="form-control">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.principal-message.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </form>
    </div>
</div>
@endsection
