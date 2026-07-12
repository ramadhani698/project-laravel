@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Prosedur</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.ppdb.prosedur.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" class="form-control" name="label" placeholder="Contoh: 1. Pendaftaran" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" placeholder="Contoh: Pendaftaran Online" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Contoh: Calon siswa melakukan pendaftaran secara online melalui website resmi sekolah." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Order (urutan)</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.ppdb.prosedur.index') }}" class="btn
    btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
@endsection