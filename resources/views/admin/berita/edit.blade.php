@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Berita</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" name="title" placeholder="Masukkan judul berita" value="{{ $berita->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ringkasan Berita</label>
                    <textarea class="form-control" name="excerpt" rows="3" placeholder="Ringkasan singkat berita" required>{{ $berita->excerpt }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea class="form-control" name="content" rows="6" placeholder="Isi berita" required>{{ $berita->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="{{ asset('uploads/berita/'.$berita->image) }}" width="200" class="mb-2">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="datetime-local" class="form-control" name="published_at" value="{{ optional($berita->published_at)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Publish</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $berita->status == 'draft' ? 'selected' : ''}}>Draft</option>
                        <option value="publish" {{ $berita->status == 'publish' ? 'selected' : ''}}>Publish</option>
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