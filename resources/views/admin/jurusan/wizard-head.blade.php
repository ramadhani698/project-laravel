@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-1 fw-bold">Tambah Jurusan Baru</h1>
        <p class="text-muted mb-0 small">Langkah 2 dari 4 — Lengkapi data Kepala Kompetensi.</p>
    </div>

    @include('admin.jurusan.partials.wizard-progress', ['currentStep' => 2])

    @if (session('success'))
        <div class="alert alert-success shadow-sm border-0">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.jurusan.head.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="wizard" value="1">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kepala Kompetensi</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jabatan</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Kepala Jurusan</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <a href="{{ route('admin.jurusan.wizard.visi-misi', $jurusan->id) }}" class="btn btn-light border text-muted">
                                Lewati Langkah Ini
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Lanjut ke Visi & Misi <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="alert alert-info small border-0 shadow-sm mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Jurusan <strong>{{ $jurusan->name }}</strong> berhasil dibuat. Sekarang lengkapi data kepala kompetensinya sebelum lanjut.
            </div>
        </div>
    </div>

</div>
@endsection