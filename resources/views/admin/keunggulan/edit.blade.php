@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Keunggulan</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.keunggulan.update', $keunggulan->id) }}" method="POST" class="form-control" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-control">Icon</label>
                    <input type="text" class="form-control" name="icon" value="{{ ($keunggulan->icon) }}">
                </div>

                <div class="mb-3">
                    <label class="form-control">Judul</label>
                    <input type="text" class="form-control" name="title" value="{{ ($keunggulan->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-control">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ ($keunggulan->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-control">Order (urutan)</label>
                    <input type="number" class="form-control" name="order" value="{{ ($keunggulan->order) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.keunggulan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection