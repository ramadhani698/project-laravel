@extends('admin.layout')

@section('title', 'Detail Calon Siswa')

@section('content')
<div class="container-fluid px-4">

    @php
        $formulir = $hasil->formulirPendaftaran;
        $pendaftar = $formulir->pendaftar ?? null;
        $berkas = $pendaftar->berkas ?? collect();

        $labelDokumen = [
            'ktp_ortu' => 'KTP Orang Tua',
            'akta_kelahiran' => 'Akta Kelahiran',
            'kartu_keluarga' => 'Kartu Keluarga',
            'ijazah' => 'Ijazah',
            'skl' => 'SKL',
            'rapor_semester_akhir' => 'Rapor Semester Akhir',
            'surat_keterangan_sehat' => 'Surat Keterangan Sehat',
        ];
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">Detail Calon Siswa</h4>
            <p class="text-body-secondary mb-0">
                No. Pendaftaran: <span class="fw-semibold text-primary-emphasis">{{ $formulir->no_pendaftaran ?? '—' }}</span>
            </p>
        </div>
        <a href="{{ route('admin.ppdb.siswa-diterima.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        {{-- Biodata --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Biodata</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5 text-body-secondary">Nama Lengkap</dt>
                        <dd class="col-7">{{ $formulir->nama_lengkap ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">NISN</dt>
                        <dd class="col-7">{{ $formulir->nisn ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">NIK</dt>
                        <dd class="col-7">{{ $formulir->nik ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">No. KK</dt>
                        <dd class="col-7">{{ $formulir->no_kk ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">No. Akta Kelahiran</dt>
                        <dd class="col-7">{{ $formulir->no_akta ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Tempat, Tanggal Lahir</dt>
                        <dd class="col-7">
                            {{ $formulir->tempat_lahir ?? '-' }}, {{ optional($formulir->tanggal_lahir)->format('d M Y') ?? '-' }}
                        </dd>

                        <dt class="col-5 text-body-secondary">Jenis Kelamin</dt>
                        <dd class="col-7">{{ $formulir->jenis_kelamin ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Alamat</dt>
                        <dd class="col-7">{{ $formulir->alamat ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Asal Sekolah</dt>
                        <dd class="col-7">{{ $formulir->asal_sekolah ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Email Akun</dt>
                        <dd class="col-7">{{ $pendaftar->email ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Keluarga --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Data Orang Tua</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5 text-body-secondary">Nama Ayah</dt>
                        <dd class="col-7">{{ $formulir->nama_ayah ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">NIK Ayah</dt>
                        <dd class="col-7">{{ $formulir->nik_ayah ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Pekerjaan Ayah</dt>
                        <dd class="col-7">{{ $formulir->pekerjaan_ayah ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Nama Ibu</dt>
                        <dd class="col-7">{{ $formulir->nama_ibu ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">NIK Ibu</dt>
                        <dd class="col-7">{{ $formulir->nik_ibu ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Pekerjaan Ibu</dt>
                        <dd class="col-7">{{ $formulir->pekerjaan_ibu ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">No. HP Orang Tua</dt>
                        <dd class="col-7">{{ $formulir->no_hp_ortu ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Jurusan & Hasil Seleksi --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Jurusan & Hasil Seleksi</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5 text-body-secondary">Jurusan Pilihan</dt>
                        <dd class="col-7">{{ $formulir->jurusan?->name ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Nilai Akademik</dt>
                        <dd class="col-7">
                            <span class="badge bg-success-subtle text-success-emphasis">
                                {{ $hasil->nilai_akademik ?? '-' }}
                            </span>
                        </dd>

                        <dt class="col-5 text-body-secondary">Nilai Kejuruan</dt>
                        <dd class="col-7">
                            <span class="badge bg-success-subtle text-success-emphasis">
                                {{ $hasil->nilai_kejuruan ?? '-' }}
                            </span>
                        </dd>

                        <dt class="col-5 text-body-secondary">Tanggal Pengumuman</dt>
                        <dd class="col-7">{{ optional($hasil->tanggal_pengumuman)->format('d M Y') ?? '-' }}</dd>

                        <dt class="col-5 text-body-secondary">Status Formulir</dt>
                        <dd class="col-7">
                            <span class="badge bg-info-subtle text-info-emphasis text-capitalize">
                                {{ str_replace('_', ' ', $formulir->status ?? '-') }}
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Berkas --}}
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent fw-semibold">Berkas Dokumen</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Jenis Dokumen</th>
                                    <th>Status</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berkas as $dokumen)
                                    <tr>
                                        <td class="ps-3">{{ $labelDokumen[$dokumen->jenis_dokumen] ?? $dokumen->jenis_dokumen }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($dokumen->status_verifikasi) {
                                                    'valid' => 'bg-success-subtle text-success-emphasis',
                                                    'ditolak' => 'bg-danger-subtle text-danger-emphasis',
                                                    default => 'bg-warning-subtle text-warning-emphasis',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} text-capitalize">
                                                {{ $dokumen->status_verifikasi }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3">
                                            <a href="{{ $dokumen->url }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-body-secondary">
                                            Belum ada berkas yang diunggah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection