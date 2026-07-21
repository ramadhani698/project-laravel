@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Bank Soal Tes Online</h1>
            <p class="text-muted mb-0 small">Kelola soal akademik dan kejuruan untuk tes online PPDB.</p>
        </div>
        <a href="{{ route('admin.ppdb.soal-tes.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Soal
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

    <!-- STAT RINGKAS -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1">{{ $totalSoal ?? $soalTes->total() }}</div>
                        <div class="text-muted small">Total Soal</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1">{{ $totalAkademik ?? '-' }}</div>
                        <div class="text-muted small">Soal Akademik</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                        <i class="fas fa-gears"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1">{{ $totalKejuruan ?? '-' }}</div>
                        <div class="text-muted small">Soal Kejuruan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width:44px;height:44px;">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1">{{ $jurusans->count() }}</div>
                        <div class="text-muted small">Jurusan Terdaftar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER & SEARCH -->
    <div class="card border-0 shadow-sm rounded-4 mb-3">
        <div class="card-body py-3 px-4">
            <form action="{{ route('admin.ppdb.soal-tes.index') }}" method="GET" class="row gy-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control border-start-0"
                               placeholder="Cari pertanyaan...">
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <select name="tipe_soal" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Tipe Soal</option>
                        <option value="akademik" {{ request('tipe_soal') === 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="kejuruan" {{ request('tipe_soal') === 'kejuruan' ? 'selected' : '' }}>Kejuruan</option>
                    </select>
                </div>
                <div class="col-md-3 col-6">
                    <select name="jurusan_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jurusan</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ (string) request('jurusan_id') === (string) $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-6">
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                        @foreach ([10, 25, 50, 100] as $n)
                            <option value="{{ $n }}" {{ (int) request('per_page', 25) === $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 col-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm flex-grow-1" title="Cari">
                        <i class="fas fa-search"></i>
                    </button>
                    @if (request('q') || request('tipe_soal') || request('jurusan_id'))
                        <a href="{{ route('admin.ppdb.soal-tes.index') }}" class="btn btn-outline-secondary btn-sm" title="Reset">
                            <i class="fas fa-xmark"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- TABEL SOAL -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            @if ($soalTes->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 soal-table">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 48px;" class="ps-4">No</th>
                                <th style="width: 130px;">Tipe</th>
                                <th>Pertanyaan</th>
                                <th style="width: 160px;">Jurusan</th>
                                <th style="width: 130px;" class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soalTes as $i => $soal)
                                @php
                                    $isKejuruan = $soal->tipe_soal === 'kejuruan';
                                    $rowId = 'detail-' . $soal->id;
                                    $opsiList = ['a' => $soal->opsi_a, 'b' => $soal->opsi_b, 'c' => $soal->opsi_c, 'd' => $soal->opsi_d];
                                    $nomor = ($soalTes->currentPage() - 1) * $soalTes->perPage() + $i + 1;
                                @endphp
                                <tr class="soal-row" role="button" data-bs-toggle="collapse" data-bs-target="#{{ $rowId }}">
                                    <td class="ps-4 text-muted">{{ $nomor }}</td>
                                    <td>
                                        @if ($isKejuruan)
                                            <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-1">
                                                <i class="fas fa-gears me-1"></i> Kejuruan
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis px-3 py-1">
                                                <i class="fas fa-book me-1"></i> Akademik
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ Str::limit($soal->pertanyaan, 90) }}</span>
                                    </td>
                                    <td>
                                        @if ($isKejuruan)
                                            <span class="badge rounded-pill bg-light text-muted border">{{ $soal->jurusan->name ?? '-' }}</span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4" onclick="event.stopPropagation()">
                                        <div class="d-flex justify-content-end align-items-center gap-2">
                                            <button class="btn btn-sm btn-outline-secondary toggle-chevron" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#{{ $rowId }}" title="Lihat detail">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                            <a href="{{ route('admin.ppdb.soal-tes.edit', $soal->id) }}"
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.ppdb.soal-tes.destroy', $soal->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus soal ini? Data yang terkait tidak dapat dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="collapse" id="{{ $rowId }}">
                                    <td colspan="5" class="p-0 border-0">
                                        <div class="bg-light-subtle px-4 py-3 mx-3 mb-3 rounded-3">
                                            <p class="mb-2 small text-muted">{{ $soal->pertanyaan }}</p>
                                            <div class="row row-cols-1 row-cols-sm-2 g-2 small">
                                                @foreach ($opsiList as $key => $isi)
                                                    @php $isBenar = $soal->kunci_jawaban === $key; @endphp
                                                    <div class="col">
                                                        <div class="d-flex align-items-center gap-2 px-2 py-1 rounded-3 {{ $isBenar ? 'bg-success-subtle' : 'bg-white' }}">
                                                            <span class="fw-bold {{ $isBenar ? 'text-success' : 'text-muted' }}" style="width: 18px;">
                                                                {{ strtoupper($key) }}
                                                            </span>
                                                            <span class="{{ $isBenar ? 'text-success-emphasis fw-semibold' : 'text-body' }}">
                                                                {{ $isi }}
                                                            </span>
                                                            @if ($isBenar)
                                                                <i class="fas fa-check-circle text-success ms-auto"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-circle-question fa-2x text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-1">Belum ada soal yang cocok</p>
                    <span class="text-muted small">
                        @if (request('q') || request('tipe_soal') || request('jurusan_id'))
                            Coba ubah kata kunci atau filter yang digunakan.
                        @else
                            Tambahkan soal akademik atau kejuruan untuk tes online.
                        @endif
                    </span>
                </div>
            @endif
        </div>
    </div>

    <!-- PAGINATION -->
    @if ($soalTes->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
            <span class="text-muted small">
                Menampilkan {{ $soalTes->firstItem() }}–{{ $soalTes->lastItem() }} dari {{ $soalTes->total() }} soal
            </span>
            {{ $soalTes->links() }}
        </div>
    @endif

</div>

<style>
    .soal-table .soal-row {
        cursor: pointer;
        transition: background-color .15s ease;
    }
    .soal-table .soal-row:hover {
        background-color: rgba(13, 110, 253, 0.04);
    }
    .soal-table .toggle-chevron i {
        transition: transform .2s ease;
    }
    .soal-table .soal-row[aria-expanded="true"] .toggle-chevron i,
    .toggle-chevron[aria-expanded="true"] i {
        transform: rotate(180deg);
    }
</style>
@endsection