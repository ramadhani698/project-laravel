@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Statistik</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.statistik.update', $statistik->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Statistik</label>
                    <input type="text" class="form-control" name="value" value="{{ $statistik->value }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" class="form-control" name="label" value="{{ $statistik->label }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Order (urutan)</label>
                    <input type="number" class="form-control" name="order" value="{{ $statistik->order }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.statistik.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection