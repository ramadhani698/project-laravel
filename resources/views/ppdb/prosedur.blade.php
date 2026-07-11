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
    // Setiap langkah: nomor urut, judul, deskripsi, dan ikon Tabler (ti-*)
    // yang melambangkan aksi pada langkah tersebut.
    $steps = [
        ['title' => 'Registrasi Akun', 'icon' => 'ti-user-plus',
         'desc'  => 'Buka menu "Pendaftaran" lalu isi data awal calon peserta didik dan lakukan pembayaran biaya pendaftaran melalui teller bank, ATM, atau mobile banking.'],
        ['title' => 'Login', 'icon' => 'ti-login-2',
         'desc'  => 'Akun aktif otomatis setelah pembayaran terverifikasi. Masuk ke website menggunakan User ID dan Password yang telah dibuat.'],
        ['title' => 'Isi Formulir', 'icon' => 'ti-forms',
         'desc'  => 'Lengkapi formulir pendaftaran secara online. Semua kolom bertanda bintang (*) wajib diisi dengan data yang benar.'],
        ['title' => 'Upload Berkas', 'icon' => 'ti-cloud-upload',
         'desc'  => 'Unggah dokumen persyaratan seperti kartu keluarga, akta kelahiran, rapor, dan pas foto pada menu "Upload Dokumen".'],
        ['title' => 'Verifikasi Berkas & Pembayaran', 'icon' => 'ti-shield-check',
         'desc'  => 'Panitia PPDB memeriksa kelengkapan dan keabsahan berkas yang diunggah beserta status pembayaran.'],
        ['title' => 'Tes / Seleksi', 'icon' => 'ti-pencil',
         'desc'  => 'Calon peserta didik mengikuti tes atau seleksi sesuai jadwal yang ditentukan oleh sekolah.'],
        ['title' => 'Pengumuman Hasil', 'icon' => 'ti-speakerphone',
         'desc'  => 'Hasil seleksi dapat dilihat melalui akun pendaftaran masing-masing pada tanggal yang telah dijadwalkan.'],
        ['title' => 'Daftar Ulang', 'icon' => 'ti-user-check',
         'desc'  => 'Calon peserta didik yang dinyatakan lulus wajib melakukan daftar ulang sesuai batas waktu yang ditentukan.'],
    ];
 
    $faqs = [
        ['q' => 'Apakah biaya pendaftaran dapat dikembalikan jika saya tidak lulus seleksi?',
         'a' => 'Biaya pendaftaran tidak dapat dikembalikan (non-refundable) karena digunakan untuk proses administrasi dan seleksi.'],
        ['q' => 'Bagaimana jika saya lupa User ID atau Password akun pendaftaran?',
         'a' => 'Silakan hubungi panitia PPDB melalui menu Kontak dengan menyertakan nomor pendaftaran dan data diri untuk verifikasi.'],
        ['q' => 'Apa yang terjadi jika berkas yang diunggah tidak lengkap atau tidak valid?',
         'a' => 'Panitia akan menghubungi calon peserta didik untuk melengkapi atau mengganti berkas sebelum batas waktu verifikasi berakhir.'],
    ];
 
    // Pecah 8 langkah menjadi baris berisi 4 kartu untuk tampilan desktop
    $stepRows = array_chunk($steps, 4);
@endphp
 
{{-- ============ HERO / RINGKASAN ============ --}}
<section class="ppdb-hero">
    <div class="box">
        <p class="eyebrow display">PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        <h1 class="display">Prosedur Pendaftaran</h1>
        <p>Ikuti 8 tahapan berikut secara berurutan agar proses pendaftaran calon peserta
           didik baru berjalan lancar, mulai dari pembuatan akun hingga daftar ulang.</p>
    </div>
</section>
 
{{-- ============ ALUR TAHAPAN PENDAFTARAN ============ --}}
<section class="ppdb-section">
    <h2 class="display">Alur Tahapan Pendaftaran</h2>
 
    {{-- Desktop: baris berisi 4 kartu + panah kanan, panah turun antar baris --}}
    <div class="step-flow-desktop">
        @foreach ($stepRows as $rowIndex => $row)
            <div class="step-flow-row">
                @foreach ($row as $i => $step)
                    @php $number = $rowIndex * 4 + $i + 1; @endphp
                    <div class="step-card">
                        <div class="icon-badge">
                            <i class="ti {{ $step['icon'] }}"></i>
                            <span class="number-badge">{{ $number }}</span>
                        </div>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['desc'] }}</p>
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
        @foreach ($steps as $i => $step)
            <div class="step-card">
                <div class="icon-badge">
                    <i class="ti {{ $step['icon'] }}"></i>
                    <span class="number-badge">{{ $i + 1 }}</span>
                </div>
                <h3>{{ $step['title'] }}</h3>
                <p>{{ $step['desc'] }}</p>
            </div>
            @if (!$loop->last)
                <div class="step-arrow-v"><i class="ti ti-arrow-down"></i></div>
            @endif
        @endforeach
    </div>
</section>
 
{{-- ============ FAQ / PERTANYAAN UMUM ============ --}}
<section class="ppdb-section">
    <h2 class="display">FAQ / Pertanyaan Umum</h2>
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