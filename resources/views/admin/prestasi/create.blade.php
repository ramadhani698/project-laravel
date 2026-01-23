@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Prestasi</h3>
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
            <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="image" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Juara</label>
                    <input type="text" class="form-control" name="juara" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" name="nama_siswa" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" class="form-control" name="tahun" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection