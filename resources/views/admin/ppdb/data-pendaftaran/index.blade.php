@extends('admin.layout')

@section('title', 'Data Pendaftaran PPDB')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Data Pendaftaran</h4>
            <p class="text-body-secondary mb-0">Verifikasi biodata dan berkas calon siswa PPDB.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
        </div>
    @endif

    @if($perluVerifikasiBaruCount > 0)
        <div class="alert alert-info d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-user-plus"></i>
            <div class="flex-grow-1">
                <strong>{{ $perluVerifikasiBaruCount }} pendaftar baru</strong> menunggu verifikasi awal admin.
            </div>
            <a href="{{ route('admin.ppdb.data-pendaftaran.index', ['status' => 'menunggu_verifikasi']) }}"
            class="btn btn-sm btn-info text-white">
                Lihat Semua
            </a>
        </div>
    @endif

    @if($perluReviewCount > 0)
        <div class="alert alert-warning d-flex align-items-center gap-2" role="alert">
            <i class="fas fa-bell"></i>
            <div class="flex-grow-1">
                <strong>{{ $perluReviewCount }} pendaftar</strong> mengunggah berkas baru dan perlu direview ulang.
            </div>
            <a href="{{ route('admin.ppdb.data-pendaftaran.index', ['status' => 'perlu_review']) }}"
            class="btn btn-sm btn-warning">
                Lihat Semua
            </a>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-3">
            <form method="GET" class="d-flex gap-2 flex-wrap align-items-center">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">Semua status</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                    <option value="menunggu_verifikasi" @selected(request('status') === 'menunggu_verifikasi')>Menunggu verifikasi</option>
                    <option value="terverifikasi" @selected(request('status') === 'terverifikasi')>Terverifikasi</option>
                    <option value="perlu_review" @selected(request('status') === 'perlu_review')>🔔 Perlu review ulang</option>
                </select>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm w-auto" placeholder="Cari nama / no. pendaftaran...">
                <button type="submit" class="btn btn-sm btn-outline-secondary">Cari</button>
                @if(request('status') || request('q'))
                    <a href="{{ route('admin.ppdb.data-pendaftaran.index') }}" class="btn btn-sm btn-link text-decoration-none">Reset</a>
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
                        <th>Progress</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formulirList as $formulir)
                        @php
                            $totalBerkas = $formulir->pendaftar->berkas->count();
                            $validBerkas = $formulir->pendaftar->berkas->where('status_verifikasi', 'valid')->count();
                            $adaBerkasBaru = $formulir->status === 'terverifikasi'
                                && $formulir->pendaftar->berkas->where('status_verifikasi', 'menunggu')->isNotEmpty();
                        @endphp
                        <tr class="{{ $adaBerkasBaru ? 'border-start border-3 border-warning' : '' }}">
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
                            <td>
                                <div class="progress" style="height: 6px; width: 90px;">
                                    <div class="progress-bar bg-success" style="width: {{ ($formulir->current_step / 5) * 100 }}%"></div>
                                </div>
                                <span class="small text-body-secondary">Step {{ min($formulir->current_step, 5) }}/5</span>
                            </td>
                            <td>
                                <span class="badge {{ $validBerkas === $totalBerkas && $totalBerkas > 0 ? 'bg-success-subtle text-success-emphasis' : 'bg-warning-subtle text-warning-emphasis' }}">
                                    {{ $validBerkas }}/{{ $totalBerkas }} valid
                                </span>
                                @if($adaBerkasBaru)
                                    <span class="badge bg-danger-subtle text-danger-emphasis ms-1" title="Ada berkas baru yang belum diverifikasi ulang">
                                        <i class="fas fa-bell"></i> Baru
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusBadge = [
                                        'draft' => 'bg-secondary-subtle text-secondary-emphasis',
                                        'menunggu_verifikasi' => 'bg-warning-subtle text-warning-emphasis',
                                        'terverifikasi' => 'bg-success-subtle text-success-emphasis',
                                    ];
                                    $statusLabel = [
                                        'draft' => 'Draft',
                                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                                        'terverifikasi' => 'Terverifikasi',
                                    ];
                                @endphp
                                <span class="badge {{ $statusBadge[$formulir->status] }}">
                                    {{ $statusLabel[$formulir->status] }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.ppdb.data-pendaftaran.edit', $formulir) }}"
                                   class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Detail
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-coreui-toggle="modal" data-coreui-target="#hapusModal{{ $formulir->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>

                                <div class="modal fade" id="hapusModal{{ $formulir->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body p-4">
                                                <h6 class="fw-semibold mb-2">Hapus data pendaftaran?</h6>
                                                <p class="text-body-secondary small mb-3">
                                                    Data biodata, keluarga, jurusan, dan berkas milik
                                                    <strong>{{ $formulir->nama_lengkap ?? 'pendaftar ini' }}</strong>
                                                    akan dihapus permanen. Akun login tetap ada dan bisa isi ulang formulir dari awal.
                                                </p>
                                                <form method="POST" action="{{ route('admin.ppdb.data-pendaftaran.destroy', $formulir) }}" class="d-flex justify-content-end gap-2">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-light btn-sm" data-coreui-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-body-secondary">
                                Belum ada data pendaftaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($formulirList->hasPages())
            <div class="card-footer bg-transparent border-0 py-3">
                {{ $formulirList->links() }}
            </div>
        @endif
    </div>
</div>
@endsection