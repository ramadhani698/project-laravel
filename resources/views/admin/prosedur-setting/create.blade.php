@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Tambah Prosedur</h5>
        </div>

        <div class="card-body">
                <form action="{{ route('admin.prosedur-setting.store') }}" method="POST">                @csrf

                <div class="mb-3">
                    <label class="form-label">label</label>
                    <input type="text" class="form-control" name="label" placeholder="Contoh: 1. Pendaftaran" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">title</label>
                    <input type="text" class="form-control" name="title" placeholder="Contoh: Pendaftaran Online" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Contoh: Calon siswa melakukan pendaftaran secara online melalui website resmi sekolah." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">order (order)</label>
                    <input type="number" class="form-control" name="order" value="0">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="aktif" name="aktif" value="1" checked>
                    <label class="form-check-label" for="aktif">Aktif (tampilkan di halaman publik)</label>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.prosedur-setting.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection