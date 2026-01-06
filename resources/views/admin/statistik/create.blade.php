@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Statistik</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.statistik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Statistik</label>
                    <input type="text" class="form-control" name="value" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" class="form-control" name="label" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Order (urutan)</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.statistik.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection