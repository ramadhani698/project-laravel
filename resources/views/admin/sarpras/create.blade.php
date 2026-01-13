@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah data fasilitas</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.sarpras.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" placeholder="Contoh: 🏫">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" class="form-control" name="order" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.sarpras.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection