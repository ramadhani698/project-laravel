@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Carousel</h5>
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
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Gambar Carousel</label>
                    <input type="file" class="form-control" name="image" required>
                    <small class="text-muted">Maksimal ukuran gambar 10 MB (jpg, jpeg, png, webp)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul (Opsional)</label>
                    <input type="text" class="form-control" name="title">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection