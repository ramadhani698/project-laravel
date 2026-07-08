@extends('ppdb.layouts.app')

@section('title', 'Persyaratan Pendaftaran')

@section('content')

<div class="pr-head-wrap">
    <div class="pr-head">
        <div class="pr-head-text">
            <span class="pr-eyebrow">Formulir Resmi &middot; SPMB 2026/2027</span>
            <h1>Persyaratan Pendaftaran SMK Muhammadiyah</h1>
            <p>Siapkan berkas berikut sebelum mendaftar. Semua dokumen diunggah dalam satu proses pendaftaran daring.</p>
        </div>

        <div class="pr-logo-wrap">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Muhammadiyah">
        </div>
    </div>
</div>

<div class="pr-body">

    <div class="pr-form-card">
        <div class="pr-form-inner">
            <div class="pr-form-title-row">
                <span class="no">01</span>
                <h2>Persyaratan Administrasi</h2>
            </div>

            <div class="pr-check-row">
                <span class="pr-checkbox">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5L20 6" stroke="#06402B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span class="teks">Biaya free (program sekolah gratis)</span>
            </div>

            <div class="pr-check-row">
                <span class="pr-checkbox">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"><path d="M4 12.5l5 5L20 6" stroke="#06402B" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <div class="teks" style="flex:1">
                    <span>Mengunggah dokumen format JPG/JPEG/PDF, maksimal 2 MB per berkas</span>
                    <h6>Daftar dokumen yang harus di siapkan sebelum lanjut mendaftar</h6>
                    <ul class="pr-sub-doclist">
                        <li>KTP orang tua</li>
                        <li>Akta Kelahiran</li>
                        <li>Kartu Keluarga</li>
                        <li>Ijazah SMP-Sederajat</li>
                        <li>Surat Keterangan Lulus SMP-Sederajat</li>
                        <li>Raport semester terakhir</li>
                        <li>Surat keterangan sehat</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pr-section-label">
        <h2>Jalur Pendaftaran</h2>
        <span>&mdash; pilih salah satu saat mengisi formulir</span>
    </div>
    <div class="pr-jalur-grid">
        <div class="pr-jalur-card">
            <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="#06402B" stroke-width="1.6"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 4v-1M16 4v-1"/></svg>
            <div>
                <h3>Jalur Reguler</h3>
                <p>Tes akademik Matematika, Bahasa Indonesia, dan Baca Tulis Al-Qur'an, ditambah wawancara minat jurusan, dan kemuhammadiyahan.</p>
            </div>
        </div>
        <div class="pr-jalur-card">
            <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="#C99A2E" stroke-width="1.6"><path d="M12 3l2.5 5.5L20 9.3l-4 4 1 5.7L12 16.5 7 19l1-5.7-4-4 5.5-0.8z"/></svg>
            <div>
                <h3>Jalur Prestasi</h3>
                <p>Melampirkan sertifikat atau piagam prestasi akademik maupun non-akademik, minimal tingkat kecamatan.</p>
            </div>
        </div>
        <div class="pr-jalur-card">
            <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="#06402B" stroke-width="1.6"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            <div>
                <h3>Jalur Tahfidz</h3>
                <p>Mengikuti tes hafalan Al-Qur'an sesuai jenjang, minimal juz 30.</p>
            </div>
        </div>
        <div class="pr-jalur-card">
            <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="#C99A2E" stroke-width="1.6"><path d="M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z"/></svg>
            <div>
                <h3>Jalur Yatim / Dhuafa</h3>
                <p>Melampirkan surat keterangan yatim atau kurang mampu dari kelurahan setempat.</p>
            </div>
        </div>
    </div>

    <div class="pr-section-label">
        <h2>Kompetensi Keahlian</h2>
        <span>&mdash; jurusan yang dibuka tahun ini</span>
    </div>
    <div class="pr-jurusan-strip">
        <div class="pr-jurusan-chip"><span class="kode">TKJ</span><span class="nama">Teknik Komputer dan Jaringan</span></div>
        <div class="pr-jurusan-chip"><span class="kode">TBSM</span><span class="nama">Teknik dan Bisnis Sepeda Motor</span></div>
        <div class="pr-jurusan-chip"><span class="kode">MPLB</span><span class="nama">Manajemen Perkantoran dan Layanan Bisnis</span></div>
        <div class="pr-jurusan-chip"><span class="kode">DKV</span><span class="nama">Desain Komunikasi dan Visual</span></div>
        <div class="pr-jurusan-chip"><span class="kode">ML</span><span class="nama">Manajemen Logistik</span></div>
        <div class="pr-jurusan-chip"><span class="kode">LK</span><span class="nama">Layanan Kesehatan</span></div>
    </div>

    <div class="pr-catatan">
        <svg class="ic" width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#06402B"/><path d="M12 8v5" stroke="#fff" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="16" r="1" fill="#fff"/></svg>
        <span><strong>Catatan:</strong> seluruh berkas wajib asli dan sesuai dokumen kependudukan yang berlaku. Berkas tidak lengkap akan menunda proses verifikasi.</span>
    </div>

</div>

@endsection