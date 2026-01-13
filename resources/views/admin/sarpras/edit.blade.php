@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah data fasilitas</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.sarpras.update', $sarpras->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" placeholder="Contoh: 🏫" value="{{ $sarpras->icon }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" required value="{{ $sarpras->title }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" required>{{ $sarpras->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" class="form-control" name="order" required value="{{ $sarpras->order }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.sarpras.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection