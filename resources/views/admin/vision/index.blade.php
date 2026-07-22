@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Visi & Misi</h1>
            <p class="text-muted mb-0 small">Kelola visi dan misi yang ditampilkan di halaman utama sekolah.</p>
        </div>

        @if ($visions->isEmpty())
            <a href="{{ route('admin.vision.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Visi Misi
            </a>
        @endif
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
                            <th>Visi</th>
                            <th>Misi</th>
                            <th width="140" class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visions as $vision)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($vision->image)
                                        <img src="{{ Storage::url('vision/'.$vision->image) }}"
                                             class="rounded-3 shadow-sm"
                                             style="width:56px;height:56px;object-fit:cover;">
                                    @else
                                        <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:56px;height:56px;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold" style="max-width: 260px;">
                                    {{ \Illuminate\Support\Str::limit($vision->vision, 100) }}
                                </td>
                                <td class="text-muted" style="max-width: 320px;">
                                    @if (is_array($vision->mission) && count($vision->mission))
                                        <ol class="ps-3 mb-0">
                                            @foreach ($vision->mission as $misi)
                                                <li>{{ \Illuminate\Support\Str::limit($misi, 60) }}</li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <span class="text-muted">Tidak ada misi</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.vision.edit', $vision->id) }}"
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.vision.destroy', $vision->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus data ini?')">
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
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-bullseye fa-2x text-muted mb-2 d-block"></i>
                                    <span class="text-muted">Data visi misi belum tersedia</span>
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