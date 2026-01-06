@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4">Edit Jurusan: {{ $jurusan->name }}</h1>

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- TABS -->
    <ul class="nav nav-tabs mb-4" id="jurusanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data"
                    type="button" role="tab">Data Jurusan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="head-tab" data-bs-toggle="tab" data-bs-target="#head"
                    type="button" role="tab">Kepala Kompetensi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="visi-tab" data-bs-toggle="tab" data-bs-target="#visi"
                    type="button" role="tab">Visi & Misi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                    type="button" role="tab">Galeri</button>
        </li>
    </ul>

    <div class="tab-content" id="jurusanTabContent">

        <!-- TAB 1: DATA JURUSAN -->
        <div class="tab-pane fade show active" id="data" role="tabpanel">
            <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Jurusan</label>
                    <input type="text" name="name" class="form-control" value="{{ $jurusan->name }}" required>
                </div>

                <!-- Short Description -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="short_description" class="form-control" rows="3" required>{{ $jurusan->short_description }}</textarea>
                </div>

                <!-- About -->
                <div class="mb-3">
                    <label class="form-label">Tentang Jurusan</label>
                    <textarea name="about" class="form-control" rows="5" required>{{ $jurusan->about }}</textarea>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ $jurusan->order }}" required>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Gambar Jurusan</label>
                    @if($jurusan->image)
                        <img src="{{ asset('uploads/jurusan/'.$jurusan->image) }}" class="img-thumbnail mb-2" width="200">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <button class="btn btn-success">Simpan Data Jurusan</button>
            </form>
        </div>

        <!-- TAB 2: KEPALA KOMPETENSI -->
        <div class="tab-pane fade" id="head" role="tabpanel">
            <form action="{{ route('admin.jurusan.head.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kepala Kompetensi</label>
                    <input type="text" name="name" class="form-control" value="{{ $jurusan->head->name ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="title" class="form-control" value="{{ $jurusan->head->title ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kepala Jurusan</label>
                    @if(isset($jurusan->head) && $jurusan->head->photo)
                        <img src="{{ asset('uploads/jurusan_head/'.$jurusan->head->photo) }}" class="img-thumbnail mb-2" width="150">
                    @endif
                    <input type="file" name="photo" class="form-control">
                </div>

                <button class="btn btn-success">Simpan Kepala Kompetensi</button>
            </form>
        </div>

        <!-- TAB 3: VISI & MISI -->
        <div class="tab-pane fade" id="visi" role="tabpanel">
            <form action="{{ route('admin.jurusan.visi-misi.update', $jurusan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" class="form-control" rows="3">{{ $jurusan->visiMisi->visi ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Misi (pisahkan baris)</label>
                    <textarea name="misi" class="form-control" rows="5">{{ implode("\n", $jurusan->visiMisi->misi ?? []) }}</textarea>
                </div>

                <button class="btn btn-success">Simpan Visi & Misi</button>
            </form>
        </div>

        <!-- TAB 4: GALERI -->
        <div class="tab-pane fade" id="gallery" role="tabpanel">
            <form action="{{ route('admin.jurusan.gallery.store', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Upload Foto Kegiatan</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>
                <button class="btn btn-success mb-3">Upload Galeri</button>
            </form>

            <div class="row">
                @foreach($jurusan->galleries as $gallery)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('uploads/jurusan_gallery/'.$gallery->image) }}" class="card-img-top">
                            <div class="card-body text-center">
                                <form action="{{ route('admin.jurusan.gallery.destroy', $gallery->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
