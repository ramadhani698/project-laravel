@extends('frontend.layouts.app')

@section('title', 'Teknik Komputer dan Jaringan')

@section('content')

<!-- HEADER -->
<section class="page-header py-5 bg-light" style="margin-top: 80px">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Teknik Komputer dan Jaringan</h1>
        <p class="text-muted col-lg-8 mx-auto">
            Jurusan yang mempelajari perakitan komputer, instalasi jaringan,
            administrasi server, serta teknologi jaringan modern.
        </p>
    </div>
</section>

<!-- DESKRIPSI JURUSAN -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <h3 class="fw-bold text-success mb-3">Tentang Jurusan TKJ</h3>
                <p class="text-muted">
                    Teknik Komputer dan Jaringan (TKJ) merupakan salah satu kompetensi
                    keahlian yang membekali peserta didik dengan kemampuan di bidang
                    perangkat keras komputer, jaringan komputer, serta sistem jaringan
                    berbasis lokal maupun internet.
                </p>
                <p class="text-muted">
                    Lulusan TKJ diharapkan mampu bekerja secara profesional,
                    berwirausaha, serta melanjutkan pendidikan ke jenjang yang lebih tinggi.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <img 
                    src="{{ asset('images/tkj/tkj.jpg') }}" 
                    alt="Kegiatan Jurusan TKJ"
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
                    alt="Kepala Kompetensi Keahlian TKJ"
                    class="img-fluid rounded-circle mb-3"
                    style="width: 160px; height: 160px; object-fit: cover;"
                >
                <h4 class="fw-bold mb-1">Budi Santoso, S.Kom</h4>
                <p class="text-muted mb-0">Kepala Kompetensi Keahlian TKJ</p>
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
                            Menjadi kompetensi keahlian unggul dalam bidang teknologi
                            komputer dan jaringan yang berlandaskan iman, ilmu, dan akhlak.
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
                            <li>Menyelenggarakan pembelajaran berbasis kompetensi</li>
                            <li>Meningkatkan keterampilan jaringan dan IT peserta didik</li>
                            <li>Menanamkan etos kerja dan profesionalisme</li>
                            <li>Mempersiapkan lulusan siap kerja dan berwirausaha</li>
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
            <h3 class="fw-bold">Kegiatan Jurusan TKJ</h3>
            <p class="text-muted">Berbagai aktivitas dan praktik peserta didik</p>
        </div>

        <div class="row g-3">
            @for ($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <img 
                        src="{{ asset("images/tkj/tkj$i.jpg") }}" 
                        alt="Kegiatan TKJ {{ $i }}"
                        class="img-fluid rounded-4 shadow-sm"
                    >
                </div>
            @endfor
        </div>
    </div>
</section>

@endsection
