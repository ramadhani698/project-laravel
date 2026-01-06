@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Visi Misi</h5>
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
            <form action="{{ route('admin.vision.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea class="form-control" name="vision" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Misi (pisahkan dengan enter)</label>
                    <textarea class="form-control" name="mission" rows="3" placeholder="Tekan Enter untuk menambah misi baru" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.vision.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection