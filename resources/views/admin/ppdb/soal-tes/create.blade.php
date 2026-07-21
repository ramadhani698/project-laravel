@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-1 text-gray-800 fw-bold">Tambah Soal Tes</h1>
        <p class="text-muted mb-0 small">Isi data soal akademik atau kejuruan untuk tes online PPDB.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.ppdb.soal-tes.store') }}" method="POST">
                @include('admin.ppdb.soal-tes._form')
            </form>
        </div>
    </div>
</div>
@endsection