@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Banner Carousel</h5>
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
            <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="{{ asset('uploads/carousel/'.$carousel->image) }}" width="200" class="mb-2">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $carousel->title }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection