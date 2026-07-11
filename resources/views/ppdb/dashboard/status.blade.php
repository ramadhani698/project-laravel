@extends('ppdb.layouts.dashboard')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="ppdb-status-page">

    <div class="status-hero">
        <div class="status-icon"><i class="ti ti-circle-check"></i></div>
        <h1>Pendaftaran berhasil dikirim</h1>
        <p class="status-sub">Terima kasih, {{ $pendaftar->nama_lengkap }}. Data kamu sudah diterima panitia PPDB.</p>

        <div class="no-pendaftaran-box">
            <span class="label">Nomor pendaftaran</span>
            <span class="value">{{ $formulir->no_pendaftaran }}</span>
        </div>

        <div class="status-badge status-{{ $formulir->status }}">
            @if($formulir->status === 'menunggu_verifikasi')
                Menunggu verifikasi berkas
            @elseif($formulir->status === 'terverifikasi')
                Berkas terverifikasi
            @endif
        </div>

        <p class="status-note">Mohon tunggu informasi selanjutnya dari panitia untuk jadwal tes/seleksi. Pastikan no. HP dan email kamu aktif untuk menerima pemberitahuan.</p>
    </div>

    @php
        $berkasDitolak = $berkas->where('status_verifikasi', 'ditolak');
    @endphp

    @if($berkasDitolak->isNotEmpty())
        <div class="ppdb-alert ppdb-alert-danger">
            <i class="ti ti-alert-triangle"></i>
            <div>
                <strong>Ada {{ $berkasDitolak->count() }} berkas yang perlu diunggah ulang.</strong>
                <p>Panitia menolak beberapa dokumen kamu. Cek catatan di bawah, lalu klik "Ganti" untuk unggah ulang.</p>
            </div>
        </div>
    @endif

    <div class="ppdb-card">
        <h2>Ringkasan data</h2>
        <div class="review-list">
            <div class="review-item"><span class="k">Nama lengkap</span><span class="v">{{ $formulir->nama_lengkap }}</span></div>
            <div class="review-item"><span class="k">NISN</span><span class="v">{{ $formulir->nisn }}</span></div>
            <div class="review-item"><span class="k">Asal sekolah</span><span class="v">{{ $formulir->asal_sekolah }}</span></div>
            <div class="review-item"><span class="k">Jurusan pilihan</span><span class="v">{{ $formulir->jurusan?->name ?? '-' }}</span></div>
        </div>
        <p class="edit-hint"><i class="ti ti-info-circle"></i> Data biodata/keluarga/jurusan sudah terkunci setelah submit. Hubungi panitia jika ada kesalahan data.</p>
    </div>

    <div class="ppdb-card">
        <h2>Berkas</h2>
        @php
            $dokumenList = [
                'ktp_ortu' => 'KTP orang tua',
                'akta_kelahiran' => 'Akta kelahiran',
                'kartu_keluarga' => 'Kartu Keluarga',
                'rapor_semester_akhir' => 'Rapor semester akhir',
                'surat_keterangan_sehat' => 'Surat keterangan sehat',
                'ijazah' => 'Ijazah',
                'skl' => 'Surat Keterangan Lulus (SKL)',
            ];
            $statusLabel = [
                'menunggu' => 'Menunggu verifikasi',
                'valid' => 'Valid',
                'ditolak' => 'Ditolak',
            ];
        @endphp
        @foreach ($dokumenList as $kode => $label)
            <div class="upload-row upload-row-{{ isset($berkas[$kode]) ? $berkas[$kode]->status_verifikasi : 'kosong' }}" data-jenis-row="{{ $kode }}">
                <div>
                    <div class="doc-name">
                        {{ $label }}
                        @if(isset($berkas[$kode]))
                            <span class="doc-status-badge doc-status-{{ $berkas[$kode]->status_verifikasi }}">
                                {{ $statusLabel[$berkas[$kode]->status_verifikasi] }}
                            </span>
                        @endif
                    </div>
                    <div class="doc-sub" data-doc-sub="{{ $kode }}">
                        @if(isset($berkas[$kode]))
                            Sudah diunggah: {{ $berkas[$kode]->nama_asli }}
                        @elseif($kode === 'ijazah')
                            Belum diunggah — boleh menyusul setelah ijazah terbit
                        @else
                            Belum diunggah
                        @endif
                    </div>
                    @if(isset($berkas[$kode]) && $berkas[$kode]->status_verifikasi === 'ditolak' && $berkas[$kode]->catatan_admin)
                        <div class="doc-catatan-ditolak">
                            <i class="ti ti-message-circle"></i> {{ $berkas[$kode]->catatan_admin }}
                        </div>
                    @endif
                </div>
                <input type="file" class="berkas-input" data-jenis="{{ $kode }}" accept=".pdf,.jpg,.jpeg,.png" hidden>
                <button type="button" class="upload-btn" onclick="this.previousElementSibling.click()">
                    {{ isset($berkas[$kode]) ? 'Ganti' : 'Unggah' }}
                </button>
            </div>
        @endforeach
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/ppdb/status.js') }}"></script>
@endpush