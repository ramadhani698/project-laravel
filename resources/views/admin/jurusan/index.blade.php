@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Data Jurusan</h1>
            <p class="text-muted mb-0 small">Kelola daftar jurusan yang ditampilkan di halaman utama sekolah.</p>
        </div>
        <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Jurusan
        </a>
    </div>

    <!-- FLASH MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4" width="60">No</th>
                            <th width="90">Gambar</th>
                            <th>Nama Jurusan</th>
                            <th>Deskripsi Singkat</th>
                            <th width="90" class="text-center">Urutan</th>
                            <th width="140" class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurusans as $jurusan)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if($jurusan->image)
                                        <img src="{{ Storage::url('jurusan/'.$jurusan->image) }}"
                                             class="rounded-3 shadow-sm"
                                             style="width:56px;height:56px;object-fit:cover;">
                                    @else
                                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:56px;height:56px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $jurusan->name }}</td>
                                <td class="text-muted">{{ Str::limit($jurusan->short_description, 70) }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis px-3 py-2">
                                        {{ $jurusan->order }}
                                    </span>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}"
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-folder-open fa-2x text-muted mb-2 d-block"></i>
                                    <span class="text-muted">Data jurusan belum tersedia</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection