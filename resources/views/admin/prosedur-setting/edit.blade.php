@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Prosedur</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.prosedur-setting.update', $prosedur->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">label</label>
                    <input type="text" class="form-control" name="label" value="{{ $prosedur->label }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">title</label>
                    <input type="text" class="form-control" name="title" value="{{ $prosedur->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">description</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ $prosedur->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">order (order)</label>
                    <input type="number" class="form-control" name="order" value="{{ $prosedur->order }}">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="aktif" name="aktif" value="1" {{ $prosedur->aktif ? 'checked' : '' }}>
                    <label class="form-check-label" for="aktif">Aktif (tampilkan di halaman publik)</label>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.prosedur-setting.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection