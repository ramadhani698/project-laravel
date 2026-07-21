@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Periode Tes Online</h1>
            <p class="text-muted mb-0 small">Atur jendela waktu pelaksanaan tes online untuk pendaftar PPDB.</p>
        </div>
        <a href="{{ route('admin.ppdb.periode-tes.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Periode
        </a>
    </div>

    <!-- FLASH MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger d-flex align-items-center shadow-sm border-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <!-- LIST PERIODE -->
    @forelse ($periodeTes as $periode)
        @php
            $isAktif = $periode->is_aktif;
            $durasiHari = $periode->tanggal_buka_tes->diffInDays($periode->tanggal_tutup_tes) + 1;
        @endphp

        <div class="card border-0 shadow-sm rounded-4 mb-3 overflow-hidden">
            <div class="d-flex">
                <!-- Accent bar -->
                <div style="width: 6px; background-color: {{ $isAktif ? '#28a745' : '#dee2e6' }};"></div>

                <div class="card-body py-3 px-4 flex-grow-1">
                    <div class="row align-items-center gy-3">

                        <!-- Nama & tanggal -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <h5 class="fw-bold mb-0">{{ $periode->nama_periode }}</h5>
                                @if ($isAktif)
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-1">
                                        <i class="fas fa-circle-dot me-1" style="font-size: 0.6rem;"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis px-3 py-1">
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="fas fa-calendar-days me-2"></i>
                                {{ $periode->tanggal_buka_tes->translatedFormat('d F Y') }}
                                <i class="fas fa-arrow-right-long mx-2" style="font-size: 0.7rem;"></i>
                                {{ $periode->tanggal_tutup_tes->translatedFormat('d F Y') }}
                                <span class="badge rounded-pill bg-light text-muted border ms-2">
                                    {{ $durasiHari }} hari
                                </span>
                            </div>
                        </div>

                        <!-- Aksi -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                                <form action="{{ route('admin.ppdb.periode-tes.toggle-aktif', $periode->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $isAktif ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                        <i class="fas {{ $isAktif ? 'fa-toggle-off' : 'fa-toggle-on' }} me-1"></i>
                                        {{ $isAktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <a href="{{ route('admin.ppdb.periode-tes.edit', $periode->id) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.ppdb.periode-tes.destroy', $periode->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus periode ini? Data yang terkait tidak dapat dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="fas fa-calendar-xmark fa-2x text-muted mb-3 d-block"></i>
                <p class="text-muted mb-1">Belum ada periode tes yang dibuat</p>
                <span class="text-muted small">Tambahkan periode untuk mengatur jendela waktu tes online.</span>
            </div>
        </div>
    @endforelse

    <!-- PAGINATION -->
    @if ($periodeTes->hasPages())
        <div class="mt-4">
            {{ $periodeTes->links() }}
        </div>
    @endif

</div>
@endsection