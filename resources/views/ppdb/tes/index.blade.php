@extends('ppdb.layouts.dashboard')

@section('title', 'Tes Online')

@section('content')
@php
    // Menentukan langkah aktif untuk stepper — murni logika tampilan,
    // tidak mengubah variabel/status yang sudah dikirim controller.
    if ($formulir->status !== 'terverifikasi') {
        $tesStep = 1;
    } elseif (!$periodeAktif) {
        $tesStep = 2;
    } elseif ($attempt && $attempt->status === 'selesai') {
        $tesStep = 4;
    } else {
        $tesStep = 3;
    }
@endphp

<div class="tes-page">

    <ul class="tes-stepper">
        <li class="{{ $tesStep > 1 ? 'is-done' : 'is-current' }}">
            <div class="tes-step-dot">
                @if($tesStep > 1)<i class="ti ti-check"></i>@else 1 @endif
            </div>
            Verifikasi Berkas
        </li>
        <li class="{{ $tesStep > 2 ? 'is-done' : ($tesStep === 2 ? 'is-current' : '') }}">
            <div class="tes-step-dot">
                @if($tesStep > 2)<i class="ti ti-check"></i>@else 2 @endif
            </div>
            Periode Aktif
        </li>
        <li class="{{ $tesStep > 3 ? 'is-done' : ($tesStep === 3 ? 'is-current' : '') }}">
            <div class="tes-step-dot">
                @if($tesStep > 3)<i class="ti ti-check"></i>@else 3 @endif
            </div>
            Kerjakan Tes
        </li>
        <li class="{{ $tesStep === 4 ? 'is-current' : '' }}">
            <div class="tes-step-dot">
                @if($tesStep === 4)<i class="ti ti-check"></i>@else 4 @endif
            </div>
            Selesai
        </li>
    </ul>

    <div class="tes-card">
        <div class="tes-card-header">
            <div class="icon"><i class="ti ti-clipboard-text"></i></div>
            <div>
                <h1>Tes Online Seleksi PPDB</h1>
                <p>Pantau status dan kerjakan tes seleksi kamu di sini.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="tes-panel is-success" style="margin-bottom: 1.25rem;">
                <i class="ti ti-circle-check icon"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($formulir->status !== 'terverifikasi')
            <div class="tes-panel is-warning">
                <i class="ti ti-hourglass icon"></i>
                <span>
                    Berkas pendaftaran kamu belum diverifikasi oleh admin. Tes online baru bisa diakses
                    setelah berkas dinyatakan <strong>terverifikasi</strong>.
                </span>
            </div>

        @elseif(!$periodeAktif)
            <div class="tes-panel is-info">
                <i class="ti ti-calendar-time icon"></i>
                <span>
                    Belum ada periode tes online yang aktif saat ini. Silakan cek kembali secara berkala,
                    atau tunggu informasi lebih lanjut dari admin.
                </span>
            </div>

        @elseif($attempt && $attempt->status === 'selesai')
            <div class="tes-panel is-success">
                <i class="ti ti-confetti icon"></i>
                <span>
                    Kamu sudah menyelesaikan tes online pada
                    <strong>{{ $attempt->waktu_selesai_mengerjakan->translatedFormat('d F Y, H:i') }}</strong>.
                    Hasil seleksi akan diumumkan oleh admin.
                </span>
            </div>

        @else
            <div class="tes-period">
                <div class="tes-period-chip">
                    <span class="label">Tes dibuka</span>
                    <span class="value">{{ $periodeAktif->tanggal_buka_tes->translatedFormat('d F Y') }}</span>
                </div>
                <div class="tes-period-chip">
                    <span class="label">Tes ditutup</span>
                    <span class="value">{{ $periodeAktif->tanggal_tutup_tes->translatedFormat('d F Y') }}</span>
                </div>
            </div>

            @if($attempt && $attempt->status === 'sedang_mengerjakan')
                <div class="tes-panel is-info" style="margin-bottom: 1.5rem;">
                    <i class="ti ti-player-play icon"></i>
                    <span>Kamu memiliki tes yang belum diselesaikan. Klik tombol di bawah untuk melanjutkan.</span>
                </div>
                <a href="{{ route('ppdb.tes.kerjakan') }}" class="tes-btn tes-btn-warning">
                    <i class="ti ti-arrow-right"></i> Lanjutkan Tes
                </a>
            @else
                <p class="tes-hint">
                    Pastikan koneksi internet kamu stabil sebelum memulai. Jawaban akan tersimpan
                    otomatis setiap kamu memilih opsi.
                </p>
                <form action="{{ route('ppdb.tes.mulai') }}" method="POST">
                    @csrf
                    <button type="submit" class="tes-btn tes-btn-primary">
                        <i class="ti ti-pencil"></i> Mulai Tes
                    </button>
                </form>
            @endif
        @endif
    </div>
</div>
@endsection