{{-- resources/views/admin/ppdb/hasil-seleksi/index.blade.php --}}
@extends('admin.layout')

@section('title', 'Hasil Seleksi PPDB')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <strong>Hasil Seleksi Peserta Didik Baru</strong>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendaftar</th>
                        <th>No. Pendaftaran</th>
                        <th class="text-center">Nilai Akademik</th>
                        <th class="text-center">Nilai Kejuruan</th>
                        <th class="text-center">Status Kelulusan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hasilSeleksi as $index => $hasil)
                        <tr>
                            <td>{{ $hasilSeleksi->firstItem() + $index }}</td>
                            <td>{{ $hasil->formulirPendaftaran->nama_lengkap ?? '-' }}</td>
                            <td>{{ $hasil->formulirPendaftaran->no_pendaftaran ?? '-' }}</td>
                            <td class="text-center">
                                {{ $hasil->nilai_akademik !== null ? number_format($hasil->nilai_akademik, 2) : '-' }}
                            </td>
                            <td class="text-center">
                                {{ $hasil->nilai_kejuruan !== null ? number_format($hasil->nilai_kejuruan, 2) : '-' }}
                            </td>
                            <td class="text-center">
                                @switch($hasil->status_kelulusan)
                                    @case('lulus')
                                        <span class="badge bg-success">Lulus</span>
                                        @break
                                    @case('tidak_lulus')
                                        <span class="badge bg-danger">Tidak Lulus</span>
                                        @break
                                    @default
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.ppdb.hasil-seleksi.show', $hasil) }}"
                                   class="btn btn-sm btn-primary">
                                    <svg class="icon icon-sm"><use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass') }}"></use></svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada data hasil seleksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $hasilSeleksi->links() }}
    </div>
</div>
@endsection