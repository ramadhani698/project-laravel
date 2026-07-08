@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-1 fw-bold">Tambah Jurusan Baru</h1>
        <p class="text-muted mb-0 small">Langkah 3 dari 4 — Lengkapi Visi & Misi.</p>
    </div>

    @include('admin.jurusan.partials.wizard-progress', ['currentStep' => 3])

    @if (session('success'))
        <div class="alert alert-success shadow-sm border-0">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.jurusan.visi-misi.update', $jurusan->id) }}" method="POST" class="col-lg-8">
                @csrf
                @method('PUT')
                <input type="hidden" name="wizard" value="1">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Visi</label>
                    <textarea name="visi" class="form-control" rows="3" required>{{ old('visi') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Misi</label>
                    <textarea name="misi" class="form-control" rows="5" required>{{ old('misi') }}</textarea>
                    <small class="text-muted">Pisahkan setiap poin misi dengan baris baru (enter).</small>
                </div>

                <div class="d-flex justify-content-between pt-3 border-top">
                    <a href="{{ route('admin.jurusan.wizard.gallery', $jurusan->id) }}" class="btn btn-light border text-muted">
                        Lewati Langkah Ini
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        Lanjut ke Galeri <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection