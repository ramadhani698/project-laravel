@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Keunggulan</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.keunggulan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" placeholder="Contoh: 🎓" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="mb-3">
                    <label class="form-control">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-control">Order (urutan)</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.keunggulan.index') }}" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
@endsection