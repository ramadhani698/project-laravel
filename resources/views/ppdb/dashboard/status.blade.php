@extends('ppdb.layouts.dashboard')

@section('title', 'Status Pendaftaran')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="ppdb-status-page">

    @php
        $currentStep = 1;
        if ($formulir->status === 'menunggu_verifikasi') $currentStep = 1;
        if ($formulir->status === 'terverifikasi') $currentStep = 2;
        if ($formulir->status === 'terverifikasi' && $hasilSeleksi) $currentStep = 3;
        if ($hasilSeleksi && $hasilSeleksi->status_kelulusan !== 'menunggu') $currentStep = 4;

        $berkasDitolak = $berkas->where('status_verifikasi', 'ditolak');
    @endphp

    {{-- ===================== HERO: KARTU PESERTA ===================== --}}
    <div class="ticket-wrap reveal-on-load">
        <div class="ppdb-ticket">
            <canvas class="ticket-particles" aria-hidden="true"></canvas>

            <div class="ticket-notch ticket-notch-left"></div>
            <div class="ticket-notch ticket-notch-right"></div>

            <div class="ticket-top">
                <div class="ticket-eyebrow">Kartu Peserta &middot; PPDB {{ now()->year }}</div>
                <h1 class="ticket-name">{{ $pendaftar->nama_lengkap }}</h1>
                <div class="status-badge status-{{ $formulir->status }}">
                    @if($formulir->status === 'menunggu_verifikasi')
                        <i class="ti ti-clock"></i> Menunggu verifikasi berkas
                    @elseif($formulir->status === 'terverifikasi')
                        <i class="ti ti-circle-check"></i> Berkas terverifikasi
                    @endif
                </div>
            </div>

            <div class="ticket-divider">
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="ticket-bottom">
                <span class="ticket-id-label">Nomor Pendaftaran</span>
                <span class="ticket-id-value" id="ticketIdValue" data-value="{{ $formulir->no_pendaftaran }}">{{ $formulir->no_pendaftaran }}</span>
                <span class="ticket-id-shimmer" aria-hidden="true"></span>
            </div>
        </div>
    </div>

    {{-- ===================== JALUR SELEKSI (timeline) ===================== --}}
    <div class="jalur-timeline reveal-on-scroll">
        @php
            $steps = [
                1 => ['icon' => 'ti-file-check', 'label' => 'Pendaftaran'],
                2 => ['icon' => 'ti-shield-check', 'label' => 'Verifikasi Berkas'],
                3 => ['icon' => 'ti-pencil', 'label' => 'Tes Online'],
                4 => ['icon' => 'ti-award', 'label' => 'Hasil Seleksi'],
            ];
        @endphp
        @foreach ($steps as $num => $step)
            <div class="jalur-step {{ $currentStep > $num ? 'is-done' : ($currentStep == $num ? 'is-active' : '') }}">
                <div class="jalur-dot"><i class="ti {{ $step['icon'] }}"></i></div>
                <span class="jalur-label">{{ $step['label'] }}</span>
            </div>
            @if(!$loop->last)
                <div class="jalur-line {{ $currentStep > $num ? 'is-done' : '' }}"></div>
            @endif
        @endforeach
    </div>

    {{-- ===================== ACTION CARD ===================== --}}
    @if($berkasDitolak->isNotEmpty())
        <div class="ppdb-alert ppdb-alert-danger reveal-on-scroll">
            <i class="ti ti-alert-triangle"></i>
            <div>
                <strong>Ada {{ $berkasDitolak->count() }} berkas yang perlu diunggah ulang</strong>
                <p>Panitia menolak beberapa dokumen kamu. Cek catatan di bagian "Berkas" di bawah, lalu unggah ulang.</p>
            </div>
        </div>
    @elseif($formulir->status === 'terverifikasi' && !$hasilSeleksi)
        <div class="ppdb-action-card ppdb-action-card-primary reveal-on-scroll">
            <div class="action-icon"><i class="ti ti-pencil"></i></div>
            <div class="action-text">
                <strong>Saatnya mengerjakan Tes Online Seleksi</strong>
                <p>Berkas kamu sudah terverifikasi. Buka halaman tes untuk melihat periode dan mulai mengerjakan.</p>
            </div>
            <a href="{{ route('ppdb.tes.index') }}" class="upload-btn upload-btn-primary">
                Buka Halaman Tes <i class="ti ti-arrow-right"></i>
            </a>
        </div>
    @elseif($hasilSeleksi && $hasilSeleksi->status_kelulusan === 'menunggu')
        <div class="ppdb-action-card reveal-on-scroll">
            <div class="action-icon"><i class="ti ti-hourglass-high"></i></div>
            <div class="action-text">
                <strong>Tes kamu sudah selesai, hasil sedang diproses</strong>
                <p>Panitia sedang memproses hasil akhir seleksi. Cek halaman ini kembali beberapa saat lagi.</p>
            </div>
        </div>
    @elseif($formulir->status === 'menunggu_verifikasi')
        <div class="ppdb-action-card reveal-on-scroll">
            <div class="action-icon"><i class="ti ti-clock"></i></div>
            <div class="action-text">
                <strong>Berkas kamu sedang diverifikasi panitia</strong>
                <p>Belum ada yang perlu kamu lakukan. Pastikan no. HP dan email kamu aktif untuk pemberitahuan selanjutnya.</p>
            </div>
        </div>
    @endif

    {{-- ===================== HASIL SELEKSI ===================== --}}
    @if($hasilSeleksi && $hasilSeleksi->status_kelulusan !== 'menunggu')
        @php $lulus = $hasilSeleksi->status_kelulusan === 'lulus'; @endphp

        <div class="ppdb-card ppdb-card-hasil ppdb-card-hasil-{{ $hasilSeleksi->status_kelulusan }} reveal-on-scroll">

            @if($lulus)
                <canvas class="hasil-confetti" aria-hidden="true"></canvas>
            @endif

            <div class="hasil-stamp-wrap">
                <div class="hasil-stamp {{ $lulus ? 'hasil-stamp-lulus' : 'hasil-stamp-netral' }}">
                    <i class="ti {{ $lulus ? 'ti-circle-check' : 'ti-heart-handshake' }}"></i>
                    <span class="hasil-stamp-ring">{{ $lulus ? 'DINYATAKAN &middot; LULUS SELEKSI' : 'TERIMA KASIH &middot; SUDAH BERPARTISIPASI' }}</span>
                </div>
            </div>

            <div class="hasil-body">
                <h2 class="hasil-heading">
                    {{ $lulus ? 'Selamat, ' . $pendaftar->nama_lengkap . '!' : 'Mohon maaf, ' . $pendaftar->nama_lengkap }}
                </h2>
                <p class="hasil-desc">
                    {{ $lulus
                        ? 'Kamu dinyatakan LULUS seleksi PPDB. Informasi daftar ulang akan disampaikan oleh panitia.'
                        : 'Kamu belum lolos seleksi PPDB kali ini. Terima kasih atas usaha dan partisipasinya — semoga sukses selalu di langkah berikutnya.' }}
                </p>

                @if($hasilSeleksi->catatan_admin)
                    <p class="edit-hint" style="margin-top: 12px;">
                        <i class="ti ti-message-circle"></i> {{ $hasilSeleksi->catatan_admin }}
                    </p>
                @endif

                <p class="hasil-tanggal">
                    <i class="ti ti-calendar-event"></i> Diumumkan {{ $hasilSeleksi->tanggal_pengumuman->translatedFormat('d F Y') }}
                </p>

                @if($lulus)
                    <a href="{{ route('ppdb.status.cetak-kartu') }}"
                    class="upload-btn upload-btn-primary"
                    target="_blank"
                    style="margin-top: 16px; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="ti ti-printer"></i> Lihat & Cetak Kartu Peserta
                    </a>

                    <a href="{{ route('ppdb.status.cetak-pernyataan') }}"
                    class="upload-btn"
                    target="_blank"
                    style="margin-top: 16px; margin-left: 8px; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="ti ti-file-text"></i> Cetak Lembar Pernyataan
                    </a>
                @endif
            </div>
        </div>
    @endif

    {{-- ===================== RINGKASAN DATA ===================== --}}
    <div class="ppdb-card reveal-on-scroll">
        <h2>Ringkasan data</h2>
        <div class="review-list">
            <div class="review-item"><span class="k">Nama lengkap</span><span class="v">{{ $formulir->nama_lengkap }}</span></div>
            <div class="review-item"><span class="k">NISN</span><span class="v">{{ $formulir->nisn }}</span></div>
            <div class="review-item"><span class="k">Asal sekolah</span><span class="v">{{ $formulir->asal_sekolah }}</span></div>
            <div class="review-item"><span class="k">Jurusan pilihan</span><span class="v">{{ $formulir->jurusan?->name ?? '-' }}</span></div>
        </div>
        <p class="edit-hint"><i class="ti ti-info-circle"></i> Data biodata/keluarga/jurusan sudah terkunci setelah submit. Hubungi panitia jika ada kesalahan data.</p>
    </div>

    {{-- ===================== BERKAS ===================== --}}
    <div class="ppdb-card reveal-on-scroll">
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
        <div class="berkas-grid">
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

                    @if(isset($berkas[$kode]) && $berkas[$kode]->status_verifikasi === 'valid')
                        <a href="{{ Storage::url($berkas[$kode]->file_path) }}" target="_blank" rel="noopener" class="upload-btn">Lihat</a>
                    @else
                        <button type="button" class="upload-btn" onclick="this.previousElementSibling.click()">
                            {{ isset($berkas[$kode]) ? 'Ganti' : 'Unggah' }}
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/ppdb/status.js') }}"></script>
@endpush