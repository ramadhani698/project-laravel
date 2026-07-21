@extends('admin.layout')

@section('title', 'Siswa Diterima PPDB')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Siswa Diterima</h4>
            <p class="text-body-secondary mb-0">Daftar calon siswa yang telah dinyatakan lulus seleksi PPDB.</p>
        </div>
        <a href="{{ route('admin.ppdb.siswa-diterima.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export ke Excel
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ppdb.siswa-diterima.index') }}" class="row g-2">
                <div class="col-12 col-md-4">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           class="form-control"
                           placeholder="Cari nama atau no. pendaftaran...">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                @if($search)
                    <div class="col-auto">
                        <a href="{{ route('admin.ppdb.siswa-diterima.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No. Pendaftaran</th>
                        <th>Nama Lengkap</th>
                        <th>Jurusan</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Akademik</th>
                        <th>Nilai Kejuruan</th>
                        <th>Tanggal Pengumuman</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswaDiterima as $hasil)
                        @php
                            $formulir = $hasil->formulirPendaftaran;
                        @endphp
                        <tr>
                            <td class="ps-4">
                                <span class="fw-semibold text-primary-emphasis">
                                    {{ $formulir->no_pendaftaran ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-medium">{{ $formulir->nama_lengkap ?? '(belum diisi)' }}</div>
                                <div class="small text-body-secondary">{{ $formulir->pendaftar->email ?? '-' }}</div>
                            </td>
                            <td>{{ $formulir->jurusan?->name ?? '-' }}</td>
                            <td>{{ $formulir->asal_sekolah ?? '-' }}</td>
                            <td>
                                <span class="badge bg-success-subtle text-success-emphasis">
                                    {{ $hasil->nilai_akademik ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success-emphasis">
                                    {{ $hasil->nilai_kejuruan ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="small text-body-secondary">
                                    {{ optional($hasil->tanggal_pengumuman)->format('d M Y') ?? '-' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.ppdb.siswa-diterima.show', $hasil) }}"
                                   class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-body-secondary">
                                @if($search)
                                    Tidak ada hasil untuk pencarian "{{ $search }}".
                                @else
                                    Belum ada siswa yang dinyatakan lulus.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($siswaDiterima->hasPages())
            <div class="card-footer bg-transparent border-0 py-3">
                {{ $siswaDiterima->links() }}
            </div>
        @endif
    </div>
</div>
@endsection