@extends('ppdb.layouts.app')

@section('title', 'Prosedur Pendaftaran - SMK Muhammadiyah')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/ppdb-prosedur.css') }}">
@endpush

@section('content')

@php
    // Ikon dipakai bergiliran sesuai urutan data dari database
    // (karena tabel prosedur_settings belum punya kolom icon)
    $icons = [
        'ti-user-plus', 'ti-login-2', 'ti-forms', 'ti-cloud-upload',
        'ti-shield-check', 'ti-pencil', 'ti-speakerphone', 'ti-user-check',
    ];

    $faqs = [
        ['q' => 'Apakah biaya pendaftaran dapat dikembalikan jika saya tidak lulus seleksi?',
         'a' => 'Biaya pendaftaran tidak dapat dikembalikan (non-refundable) karena digunakan untuk proses administrasi dan seleksi.'],
        ['q' => 'Bagaimana jika saya lupa User ID atau Password akun pendaftaran?',
         'a' => 'Silakan hubungi panitia PPDB melalui menu Kontak dengan menyertakan nomor pendaftaran dan data diri untuk verifikasi.'],
        ['q' => 'Apa yang terjadi jika berkas yang diunggah tidak lengkap atau tidak valid?',
         'a' => 'Panitia akan menghubungi calon peserta didik untuk melengkapi atau mengganti berkas sebelum batas waktu verifikasi berakhir.'],
    ];

    // Pecah data prosedur menjadi baris berisi 4 kartu untuk tampilan desktop
    $stepRows = $prosedurs->chunk(4);
@endphp

{{-- ============ HERO / RINGKASAN ============ --}}
<section class="ppdb-hero">
    <div class="box">
        <p class="eyebrow display">PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        <h1 class="display">Prosedur Pendaftaran</h1>
        <p>Ikuti {{ $prosedurs->count() }} tahapan berikut secara berurutan agar proses pendaftaran calon peserta
           didik baru berjalan lancar, mulai dari pembuatan akun hingga daftar ulang.</p>
    </div>
</section>

{{-- ============ ALUR TAHAPAN PENDAFTARAN ============ --}}
<section class="ppdb-section">
    <h2 class="display">Alur Tahapan Pendaftaran</h2>

    @if ($prosedurs->isEmpty())
        <p class="text-center">Data prosedur belum tersedia.</p>
    @else
        {{-- Desktop: baris berisi 4 kartu + panah kanan, panah turun antar baris --}}
        <div class="step-flow-desktop">
            @foreach ($stepRows as $rowIndex => $row)
                <div class="step-flow-row">
                    @foreach ($row as $i => $prosedur)
                        @php
                            $number = $rowIndex * 4 + $i + 1;
                            $icon = $icons[($number - 1) % count($icons)];
                        @endphp
                        <div class="step-card">
                            <div class="icon-badge">
                                <i class="ti {{ $icon }}"></i>
                                <span class="number-badge">{{ $number }}</span>
                            </div>
                            <h3>{{ $prosedur->title }}</h3>
                            <p>{{ $prosedur->description }}</p>
                        </div>
                        @if (!$loop->last)
                            <div class="step-arrow-h"><i class="ti ti-arrow-right"></i></div>
                        @endif
                    @endforeach
                </div>
                @if (!$loop->last)
                    <div class="step-arrow-wrap"><i class="ti ti-corner-down-left"></i></div>
                @endif
            @endforeach
        </div>

        {{-- Mobile: satu kolom, panah turun antar langkah --}}
        <div class="step-flow-mobile">
            @foreach ($prosedurs as $i => $prosedur)
                @php $icon = $icons[$i % count($icons)]; @endphp
                <div class="step-card">
                    <div class="icon-badge">
                        <i class="ti {{ $icon }}"></i>
                        <span class="number-badge">{{ $i + 1 }}</span>
                    </div>
                    <h3>{{ $prosedur->title }}</h3>
                    <p>{{ $prosedur->description }}</p>
                </div>
                @if (!$loop->last)
                    <div class="step-arrow-v"><i class="ti ti-arrow-down"></i></div>
                @endif
            @endforeach
        </div>
    @endif
</section>

{{-- ============ FAQ / PERTANYAAN UMUM ============ --}}
<section class="ppdb-section">
    <h2 class="display">Pertanyaan Umum</h2>
    <div style="display:flex;flex-direction:column;gap:0.75rem" x-data="{ open: null }">
        @foreach ($faqs as $i => $faq)
            <div class="faq-item">
                <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}">
                    <span class="q">{{ $faq['q'] }}</span>
                    <span class="toggle" :class="open === {{ $i }} ? 'open' : ''">+</span>
                </button>
                <div class="answer" x-show="open === {{ $i }}" x-cloak>{{ $faq['a'] }}</div>
            </div>
        @endforeach
    </div>
</section>

@endsection