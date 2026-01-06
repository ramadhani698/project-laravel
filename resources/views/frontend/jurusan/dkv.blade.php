@extends('frontend.layouts.app')

@section('title', 'Desain Komunikasi Visual')

@section('content')

<!-- HEADER -->
<section class="page-header py-5 bg-light" style="margin-top: 80px;">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Desain Komunikasi Visual</h1>
        <p class="text-muted col-lg-8 mx-auto">
            Jurusan yang mempelajari desain grafis, ilustrasi, fotografi,
            multimedia, serta komunikasi visual kreatif.
        </p>
    </div>
</section>

<!-- DESKRIPSI JURUSAN -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <h3 class="fw-bold text-success mb-3">Tentang Jurusan DKV</h3>
                <p class="text-muted">
                    Desain Komunikasi Visual (DKV) merupakan kompetensi keahlian
                    yang berfokus pada pengembangan kreativitas peserta didik
                    dalam menyampaikan pesan melalui media visual yang efektif
                    dan komunikatif.
                </p>
                <p class="text-muted">
                    Peserta didik dibekali keterampilan desain grafis, branding,
                    ilustrasi, fotografi, animasi dasar, serta produksi media digital.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <img 
                    src="{{ asset('images/dkv/dkv.jpg') }}" 
                    alt="Kegiatan Jurusan DKV"
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
                    alt="Kepala Kompetensi Keahlian DKV"
                    class="img-fluid rounded-circle mb-3"
                    style="width: 160px; height: 160px; object-fit: cover;"
                >
                <h4 class="fw-bold mb-1">Siti Nurhaliza, S.Ds</h4>
                <p class="text-muted mb-0">Kepala Kompetensi Keahlian DKV</p>
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
                            Menjadi kompetensi keahlian unggul dalam bidang desain
                            komunikasi visual yang kreatif, inovatif, dan berkarakter.
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
                            <li>Menyelenggarakan pembelajaran berbasis proyek kreatif</li>
                            <li>Mengembangkan kreativitas dan kemampuan visual peserta didik</li>
                            <li>Membekali peserta didik dengan keterampilan industri kreatif</li>
                            <li>Menanamkan sikap profesional dan etos kerja</li>
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
            <h3 class="fw-bold">Kegiatan Jurusan DKV</h3>
            <p class="text-muted">Hasil karya dan aktivitas kreatif peserta didik</p>
        </div>

        <div class="row g-3">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <img 
                        src="{{ asset("images/dkv/dkv$i.jpg") }}" 
                        alt="Kegiatan DKV {{ $i }}"
                        class="img-fluid rounded-4 shadow-sm"
                    >
                </div>
            @endfor
        </div>
    </div>
</section>

@endsection
