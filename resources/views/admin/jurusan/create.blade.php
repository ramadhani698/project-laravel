@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-light border me-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="h3 mb-1 fw-bold">Tambah Jurusan</h1>
            <p class="text-muted mb-0 small">Lengkapi informasi jurusan baru di bawah ini.</p>
        </div>
    </div>

    <!-- ERROR MESSAGE -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm border-0">
            <div class="fw-semibold mb-1"><i class="fas fa-exclamation-circle me-1"></i> Terdapat kesalahan input:</div>
            <ul class="mb-0 ps-3 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form id="jurusanCreateForm" action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Jurusan</label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                   placeholder="Contoh: Teknik Komputer dan Jaringan"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea name="short_description" class="form-control" rows="3"
                                      placeholder="Ringkasan singkat yang tampil di kartu jurusan"
                                      required>{{ old('short_description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tentang Jurusan</label>
                            <textarea name="about" class="form-control" rows="6"
                                      placeholder="Penjelasan lengkap mengenai jurusan ini"
                                      required>{{ old('about') }}</textarea>
                        </div>

                        <div class="mb-4" style="max-width:200px;">
                            <label class="form-label fw-semibold">Urutan Tampil</label>
                            <input type="number" name="order" class="form-control" value="{{ old('order', 1) }}" required>
                            <small class="text-muted">Angka lebih kecil tampil lebih dulu.</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan Jurusan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- IMAGE UPLOAD SIDE -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <label class="form-label fw-semibold d-block text-start">Gambar Jurusan</label>

                    <div id="imagePreviewWrapper"
                        class="rounded-4 bg-light d-flex align-items-center justify-content-center mb-3"
                        style="height:200px; overflow:hidden;">
                        <div id="imagePlaceholder" class="text-muted">
                            <i class="fas fa-image fa-2x d-block mb-2"></i>
                            <span class="small">Belum ada gambar</span>
                        </div>
                        <img id="imagePreview" src="" class="w-100 h-100 d-none" style="object-fit:cover;">
                    </div>

                    <!-- Input file TETAP di dalam <form> utama (lihat form action di bawah) -->
                    <input type="file"
                        name="image"
                        id="imageInputReal"
                        form="jurusanCreateForm"
                        class="d-none"
                        accept="image/*"
                        required>

                    <label class="btn btn-outline-primary w-100" for="imageInputReal">
                        <i class="fas fa-upload me-1"></i> Pilih Gambar
                    </label>
                    <small class="text-muted d-block mt-2">Format JPG/PNG, disarankan rasio 4:3.</small>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('imageInputReal');
        if (!input) return; // safety net kalau elemen belum ada

        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (ev) {
                document.getElementById('imagePlaceholder').classList.add('d-none');
                const img = document.getElementById('imagePreview');
                img.src = ev.target.result;
                img.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
@endsection