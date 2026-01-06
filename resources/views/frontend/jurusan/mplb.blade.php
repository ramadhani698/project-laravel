@extends('frontend.layouts.app')

@section('title', 'Manajemen Perkantoran dan Layanan Bisnis')

@section('content')

<!-- HEADER -->
<section class="page-header py-5 bg-light" style="margin-top: 80px;">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Manajemen Perkantoran dan Layanan Bisnis</h1>
        <p class="text-muted col-lg-8 mx-auto">
            Jurusan yang membekali peserta didik dengan keterampilan administrasi
            perkantoran, layanan bisnis, serta pengelolaan dokumen secara profesional.
        </p>
    </div>
</section>

<!-- DESKRIPSI JURUSAN -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <h3 class="fw-bold text-success mb-3">Tentang Jurusan MPLB</h3>
                <p class="text-muted">
                    Manajemen Perkantoran dan Layanan Bisnis (MPLB) merupakan
                    kompetensi keahlian yang mempersiapkan peserta didik
                    menjadi tenaga administrasi profesional yang terampil,
                    rapi, komunikatif, dan beretika.
                </p>
                <p class="text-muted">
                    Peserta didik dibekali keterampilan pengelolaan arsip,
                    administrasi perkantoran, korespondensi, layanan pelanggan,
                    serta teknologi perkantoran modern.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <img 
                    src="{{ asset('images/mplb/mplb.jpg') }}" 
                    alt="Kegiatan Jurusan MPLB"
                    class="img-fluid rounded-4 shadow"
                >
            </div>
        </div>
    </div>
</section>

<!-- KEPALA KOMPETENSI KEAHLIAN -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <img 
                    src="{{ asset('images/kepsek.jpg') }}" 
                    alt="Kepala Kompetensi Keahlian MPLB"
                    class="img-fluid rounded-circle mb-3"
                    style="width: 160px; height: 160px; object-fit: cover;"
                >
                <h4 class="fw-bold mb-1">Rina Kartika, S.E</h4>
                <p class="text-muted mb-0">Kepala Kompetensi Keahlian MPLB</p>
            </div>
        </div>
    </div>
</section>

<!-- VISI & MISI JURUSAN -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- VISI -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-success mb-3">Visi Jurusan</h4>
                        <p class="text-muted">
                            Menjadi kompetensi keahlian unggul dalam bidang
                            manajemen perkantoran dan layanan bisnis yang
                            profesional dan berkarakter.
                        </p>
                    </div>
                </div>
            </div>

            <!-- MISI -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-success mb-3">Misi Jurusan</h4>
                        <ul class="text-muted ps-3">
                            <li>Menyelenggarakan pembelajaran administrasi berbasis kompetensi</li>
                            <li>Mengembangkan keterampilan komunikasi dan pelayanan</li>
                            <li>Menanamkan sikap disiplin, rapi, dan bertanggung jawab</li>
                            <li>Mempersiapkan lulusan siap kerja dan berdaya saing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GALERI KEGIATAN -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Kegiatan Jurusan MPLB</h3>
            <p class="text-muted">Aktivitas pembelajaran dan praktik administrasi</p>
        </div>

        <div class="row g-3">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <img 
                        src="{{ asset("images/mplb/mplb$i.jpg") }}" 
                        alt="Kegiatan MPLB {{ $i }}"
                        class="img-fluid rounded-4 shadow-sm"
                    >
                </div>
            @endfor
        </div>
    </div>
</section>

@endsection
