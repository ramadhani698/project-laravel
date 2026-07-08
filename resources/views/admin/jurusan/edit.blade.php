@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.jurusan.index') }}" class="btn btn-light border me-3">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="h3 mb-1 fw-bold">Edit Jurusan</h1>
            <p class="text-muted mb-0 small">{{ $jurusan->name }}</p>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <ul class="nav nav-pills gap-2" id="jurusanTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-3" id="data-tab" data-bs-toggle="tab"
                            data-bs-target="#data" type="button" role="tab">
                        <i class="fas fa-info-circle me-1"></i> Data Jurusan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="head-tab" data-bs-toggle="tab"
                            data-bs-target="#head" type="button" role="tab">
                        <i class="fas fa-user-tie me-1"></i> Kepala Kompetensi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="visi-tab" data-bs-toggle="tab"
                            data-bs-target="#visi" type="button" role="tab">
                        <i class="fas fa-bullseye me-1"></i> Visi & Misi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="gallery-tab" data-bs-toggle="tab"
                            data-bs-target="#gallery" type="button" role="tab">
                        <i class="fas fa-images me-1"></i> Galeri
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-4">
            <div class="tab-content" id="jurusanTabContent">

                <!-- TAB 1: DATA JURUSAN -->
                <div class="tab-pane fade show active" id="data" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Jurusan</label>
                                    <input type="text" name="name" class="form-control" value="{{ $jurusan->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi Singkat</label>
                                    <textarea name="short_description" class="form-control" rows="3" required>{{ $jurusan->short_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tentang Jurusan</label>
                                    <textarea name="about" class="form-control" rows="5" required>{{ $jurusan->about }}</textarea>
                                </div>

                                <div class="mb-3" style="max-width:180px;">
                                    <label class="form-label fw-semibold">Urutan Tampil</label>
                                    <input type="number" name="order" class="form-control" value="{{ $jurusan->order }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Gambar Jurusan</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="text-end pt-2 border-top">
                                    <button class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Data Jurusan</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Preview Saat Ini</label>
                            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center" style="height:180px; overflow:hidden;">
                                @if($jurusan->image)
                                    <img src="{{ Storage::url('jurusan/'.$jurusan->image) }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: KEPALA KOMPETENSI -->
                <div class="tab-pane fade" id="head" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <form action="{{ route('admin.jurusan.head.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Kepala Kompetensi</label>
                                    <input type="text" name="name" class="form-control" value="{{ $jurusan->head->name ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jabatan</label>
                                    <input type="text" name="title" class="form-control" value="{{ $jurusan->head->title ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Foto Kepala Jurusan</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                                <div class="text-end pt-2 border-top">
                                    <button class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Kepala Kompetensi</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold">Foto Saat Ini</label>
                            <div class="rounded-4 bg-light d-flex align-items-center justify-content-center" style="height:180px; overflow:hidden;">
                                @if(isset($jurusan->head) && $jurusan->head->photo)
                                    <img src="{{ Storage::url('jurusan_head/'.$jurusan->head->photo) }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <i class="fas fa-user fa-2x text-muted"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: VISI & MISI -->
                <div class="tab-pane fade" id="visi" role="tabpanel">
                    <form action="{{ route('admin.jurusan.visi-misi.update', $jurusan->id) }}" method="POST" class="col-lg-8">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Visi</label>
                            <textarea name="visi" class="form-control" rows="3">{{ $jurusan->visiMisi->visi ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Misi</label>
                            <textarea name="misi" class="form-control" rows="5">{{ implode("\n", $jurusan->visiMisi->misi ?? []) }}</textarea>
                            <small class="text-muted">Pisahkan setiap poin misi dengan baris baru (enter).</small>
                        </div>

                        <div class="text-end pt-2 border-top">
                            <button class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Simpan Visi & Misi</button>
                        </div>
                    </form>
                </div>

                <!-- TAB 4: GALERI -->
                <div class="tab-pane fade" id="gallery" role="tabpanel">
                    <form action="{{ route('admin.jurusan.gallery.store', $jurusan->id) }}" method="POST" enctype="multipart/form-data"
                          class="d-flex align-items-end gap-2 mb-4 flex-wrap">
                        @csrf
                        <div class="flex-grow-1" style="min-width:250px;">
                            <label class="form-label fw-semibold">Upload Foto Kegiatan</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                        <button class="btn btn-primary"><i class="fas fa-upload me-1"></i> Upload</button>
                    </form>

                    <div class="row g-3">
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
                                        <button class="btn btn-sm btn-danger rounded-circle" title="Hapus" style="width:32px;height:32px;">
                                            <i class="fas fa-trash small"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-5">
                                <i class="fas fa-images fa-2x mb-2 d-block"></i>
                                Belum ada foto galeri untuk jurusan ini
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection