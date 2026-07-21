@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Kelola Jalur Pendaftaran</h2>
        <a href="{{ route('admin.jalur-pendaftaran.create') }}" class="btn btn-warning text-white fw-semibold">
            <i class="fa-solid fa-plus me-1"></i> Tambah Jalur
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th class="ps-3" style="width: 70px;">Urutan</th>
                            <th style="width: 200px;">Nama Jalur</th>
                            <th>Deskripsi</th>
                            <th style="width: 100px;">Aktif</th>
                            <th class="pe-3" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jalurs as $jalur)
                            <tr>
                                <td class="ps-3">{{ $jalur->urutan }}</td>
                                <td class="fw-medium">{{ $jalur->nama_jalur }}</td>
                                <td class="text-muted">{{ Str::limit($jalur->deskripsi, 70) }}</td>
                                <td>
                                    @if ($jalur->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="pe-3">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.jalur-pendaftaran.edit', $jalur) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.jalur-pendaftaran.destroy', $jalur) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus jalur ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada data jalur pendaftaran.
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