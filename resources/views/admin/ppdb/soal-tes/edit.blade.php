@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-1 text-gray-800 fw-bold">Edit Soal Tes</h1>
        <p class="text-muted mb-0 small">Perbarui data soal ini.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.ppdb.soal-tes.update', $soalTe->id) }}" method="POST">
                @method('PUT')
                @include('admin.ppdb.soal-tes._form')
            </form>
        </div>
    </div>
</div>
@endsection