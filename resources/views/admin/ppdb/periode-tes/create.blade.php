@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.ppdb.periode-tes.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 36px; height: 36px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Tambah Periode Tes</h1>
            <p class="text-muted mb-0 small">Buat jendela waktu baru untuk pelaksanaan tes online.</p>
        </div>
    </div>

    <form action="{{ route('admin.ppdb.periode-tes.store') }}" method="POST">
        @csrf

        @include('admin.ppdb.periode-tes._form')

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.ppdb.periode-tes.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary shadow-sm">
                <i class="fas fa-check me-1"></i> Simpan Periode
            </button>
        </div>
    </form>

</div>
@endsection