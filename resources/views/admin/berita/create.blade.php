@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Berita</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" name="title" placeholder="Masukkan judul berita" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan Berita</label>
                    <textarea class="form-control" name="excerpt" rows="3" placeholder="Ringkasan singkat berita" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea class="form-control" name="content" rows="6" placeholder="Isi berita" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Berita</label>
                    <input type="file" class="form-control" name="image" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="datetime-local" class="form-control" name="published_at">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Publish</label>
                    <select name="status" class="form-select">
                        <option value="draft">Draft</option>
                        <option value="publish">Publish</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection