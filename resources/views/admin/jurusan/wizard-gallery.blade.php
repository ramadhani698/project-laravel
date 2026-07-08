@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h1 class="h3 mb-1 fw-bold">Tambah Jurusan Baru</h1>
        <p class="text-muted mb-0 small">Langkah 4 dari 4 — Upload foto galeri kegiatan jurusan.</p>
    </div>

    @include('admin.jurusan.partials.wizard-progress', ['currentStep' => 4])

    @if (session('success'))
        <div class="alert alert-success shadow-sm border-0">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.jurusan.gallery.store', $jurusan->id) }}" method="POST" enctype="multipart/form-data"
                  class="d-flex align-items-end gap-2 flex-wrap">
                @csrf
                <input type="hidden" name="wizard" value="1">

                <div class="flex-grow-1" style="min-width:250px;">
                    <label class="form-label fw-semibold">Upload Foto Kegiatan</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                </div>
                <button class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i> Upload
                </button>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @forelse($jurusan->galleries as $gallery)
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <img src="{{ Storage::url('jurusan_gallery/'.$gallery->image) }}"
                         class="w-100" style="height:140px; object-fit:cover;">
                    <form action="{{ route('admin.jurusan.gallery.destroy', $gallery->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                          class="position-absolute top-0 end-0 m-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger rounded-circle" style="width:32px;height:32px;">
                            <i class="fas fa-trash small"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">
                <i class="fas fa-images fa-2x mb-2 d-block"></i>
                Belum ada foto galeri, upload minimal 1 foto disarankan.
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-end pt-3 border-top">
        <a href="{{ route('admin.jurusan.wizard.finish', $jurusan->id) }}" class="btn btn-success px-4">
            <i class="fas fa-check me-1"></i> Selesai & Simpan Jurusan
        </a>
    </div>

</div>
@endsection