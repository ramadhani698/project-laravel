@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Sejarah</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.histories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" class="form-control" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="mb-3">
                    <label class="form-label">Posisi Gambar</label>
                    <select name="position" class="form-select">
                        <option value="left">Kiri</option>
                        <option value="right">Kanan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Order</label>
                    <input type="number" class="form-control" name="order">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.histories.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection