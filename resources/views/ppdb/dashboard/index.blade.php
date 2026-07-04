@extends('ppdb.layouts.dashboard')

@section('title', 'Formulir Pendaftaran')

@section('content')

    @include('ppdb.dashboard.partials.tracker')

    <div class="ppdb-card">

        @include('ppdb.dashboard.partials.step-biodata')
        @include('ppdb.dashboard.partials.step-keluarga')
        @include('ppdb.dashboard.partials.step-jurusan')
        @include('ppdb.dashboard.partials.step-berkas')
        @include('ppdb.dashboard.partials.step-review')

        <div class="nav-btns">
            <button class="btn btn-ghost" id="btnBack">Kembali</button>
            <button class="btn btn-primary" id="btnNext">Lanjut</button>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/ppdb/dashboard.js') }}"></script>
@endpush