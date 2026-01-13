@extends('frontend.layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-sarpras position-relative">
    <img src="{{ asset('images/fasilitas.jpg') }}" class="w-100 hero-img" alt="Sarana dan Prasarana">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <h1>Sarana dan Prasarana</h1>
        <p>Fasilitas pendukung kegiatan belajar mengajar SMK Muhammadiyah 2 Tangerang</p>
    </div>
</section>


{{-- ================= SARANA & PRASARANA ================= --}}
<section class="sarpras-section py-5">
    <div class="container">

        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="sarpras-title">Daftar Sarana dan Prasarana</h2>
                <p class="sarpras-subtitle">
                    Fasilitas yang tersedia untuk mendukung proses pembelajaran siswa
                </p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($sarpras as $index => $item)

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="sarpras-card">
                        <div class="sarpras-icon">{{ $item->icon }}</div>
                        <h5>{{ $item->title }}</h5>
                        <p>
                            {{ $item->description }}
                        </p>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <p class="text-center">Data sarana dan prasarana yang belum tersedia.</p>
                </div>
            @endforelse

            <!-- {{-- 2 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="sarpras-card">
                    <div class="sarpras-icon">💻</div>
                    <h5>Laboratorium Komputer</h5>
                    <p>
                        Lab komputer dengan perangkat terbaru dan jaringan internet
                        untuk menunjang pembelajaran TKJ dan DKV.
                    </p>
                </div>
            </div>

            {{-- 3 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="sarpras-card">
                    <div class="sarpras-icon">🖥️</div>
                    <h5>Laboratorium Jaringan</h5>
                    <p>
                        Laboratorium khusus praktik jaringan komputer dengan router,
                        switch, dan server.
                    </p>
                </div>
            </div>

            {{-- 4 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="sarpras-card">
                    <div class="sarpras-icon">🎨</div>
                    <h5>Studio Desain Grafis</h5>
                    <p>
                        Studio DKV dengan perangkat desain, software grafis,
                        dan tablet gambar.
                    </p>
                </div>
            </div>

            {{-- 5 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="sarpras-card">
                    <div class="sarpras-icon">📚</div>
                    <h5>Perpustakaan</h5>
                    <p>
                        Perpustakaan sekolah dengan koleksi buku pelajaran,
                        referensi, dan bacaan umum.
                    </p>
                </div>
            </div>

            {{-- 6 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                <div class="sarpras-card">
                    <div class="sarpras-icon">🕌</div>
                    <h5>Mushola</h5>
                    <p>
                        Mushola yang nyaman untuk kegiatan ibadah siswa dan guru
                        di lingkungan sekolah.
                    </p>
                </div>
            </div>

            {{-- 7 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="700">
                <div class="sarpras-card">
                    <div class="sarpras-icon">⚽</div>
                    <h5>Lapangan Olahraga</h5>
                    <p>
                        Lapangan olahraga untuk kegiatan olahraga, upacara,
                        dan ekstrakurikuler siswa.
                    </p>
                </div>
            </div>

            {{-- 8 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="800">
                <div class="sarpras-card">
                    <div class="sarpras-icon">🩺</div>
                    <h5>UKS</h5>
                    <p>
                        Unit Kesehatan Sekolah sebagai fasilitas pertolongan pertama
                        bagi siswa.
                    </p>
                </div>
            </div>

            {{-- 9 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="900">
                <div class="sarpras-card">
                    <div class="sarpras-icon">🅿️</div>
                    <h5>Area Parkir</h5>
                    <p>
                        Area parkir yang luas dan aman untuk kendaraan siswa,
                        guru, dan staf sekolah.
                    </p>
                </div>
            </div> -->

        </div>

    </div>
</section>

@endsection
