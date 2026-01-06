@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    
    <!-- CAROUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-wrap="true" data-bs-pause="false">
        
        <!-- CAROUSEL INDICATORS -->
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}">
                </button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($carousels as $index => $carousel)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('uploads/carousel/' . $carousel->image) }}" alt="Carousel Image" class="d-block w-100">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- WELCOME -->
    <section class="home-section" id="home-section">
      <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="home-title text-center">
                <h4 data-aos="fade-up">Selamat Datang di</h4>
                <h2 data-aos="zoom-in" data-aos-delay="150">
                    SMK Muhammadiyah 2 Tangerang
                </h2>
            </div>
        </div>
      </div>
    </section>

    <!-- KEUNGGULAN -->
    <section class="keunggulan-section py-5">
        <div class="container">

            <!-- Judul -->
            <div class="row mb-5 text-center">
                <div class="col">
                    <h2 class="keunggulan-title">Keunggulan Sekolah</h2>
                    <p class="keunggulan-subtitle">
                        Alasan memilih SMK Muhammadiyah 2 Tangerang
                    </p>
                </div>
            </div>

            <!-- Card -->
            <div class="row g-4">
                @foreach ($keunggulans as $index => $item)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 150 + $index * 150 }}">
                        <div class="keunggulan-card">
                            <div class="keunggulan-icon">{{ $item->icon }}</div>
                            <h5>{{ $item->title }}</h5>
                            <p>
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- JURUSAN -->
     <section class="jurusan-section py-5">
        <div class="container">
            <div class="row align-items-center">

                <!-- KIRI: Gambar & Deskripsi -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="jurusan-left">
                        <img src="{{ asset('images/jurusan.jpg') }}" alt="jurusan" class="img-fluid jurusan-img">
                        <h2 class="mt-4">Jurusan Unggulan</h2>
                        <p>
                            SMK Muhammadiyah 2 Tangerang memiliki beberapa jurusan unggulan
                            yang dirancang untuk membekali siswa dengan keterampilan siap kerja,
                            kreatif, dan profesional di bidangnya masing-masing.
                        </p>
                    </div>
                </div>

                <!-- KANAN: Daftar Jurusan -->
                <div class="col-lg-6">
                    <div class="row g-4">

                    @forelse ($jurusans as $index => $jurusan)
                        <div class="col-12" data-aos="flip-left" data-aos-delay="{{ ($index + 1) * 150 }}">
                            <div class="jurusan-card">
                                <h5>{{ $jurusan->name }}</h5>
                                <p>
                                    {{ $jurusan->short_description }}
                                </p>
                                <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="stretched-link" aria-label="Lihat jurusan {{ $jurusan->name }}"></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted">Data jurusan belum tersedia.</p>
                        </div>
                    @endforelse

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- STATISTIK -->
    <section class="statistik-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="statistik-title">Statistik Sekolah</h2>
                    <p class="statistik-subtitle">
                        Data perkembangan SMK Muhammadiyah 2 Tangerang
                    </p>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($statistiks as $index => $item)
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ 150 + $index * 150 }}">
                    <div class="statistik-card">
                        <h3 class="statistik-number">
                            <span class="counter" data-target="{{ $item->value }}">0</span>
                            <span class="plus">+</span>
                        </h3>
                        <p>{{ $item->label }}</p>
                    </div>
                </div>
                @empty
                <div class="col text-center">
                    <p class="text-muted">Data tidak ada</p>
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- BERITA -->
    <section class="berita-section py-5">
        <div class="container">

            <!-- Judul Section -->
            <div class="row mb-4 text-center">
                <div class="col">
                    <h2 class="berita-title">Berita Terbaru</h2>
                    <p class="berita-subtitle">
                        Informasi dan kegiatan terbaru SMK Muhammadiyah 2 Tangerang
                    </p>
                </div>
            </div>

            <!-- List Berita -->
            <div class="row g-4">

                {{-- Maksimal 9 berita --}}
                @forelse ($beritas as $index => $berita)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 150 }}">
                        <div class="berita-card">
                            <div class="berita-img">
                                <img src="{{ asset('uploads/berita/'.$berita->image) }}" alt="{{ $berita->title }}">
                            </div>
                            <div class="berita-body">
                                <span class="berita-date">{{ optional($berita->published_at)->translatedFormat('d F Y') }}</span>
                                <h5 class="berita-title-card">
                                    {{ $berita->title }}
                                </h5>
                                <p class="berita-desc">
                                    {{ $berita->excerpt }}
                                </p>
                                <a href="{{ route('berita.show', $berita->slug) }}" class="berita-link">Baca Selengkapnya →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col text-center">
                        <p class="text-muted">Data berita belum tersedia.</p>
                    </div>
                @endforelse

            </div>

            <!-- Button Berita Lainnya -->
            <div class="row mt-5">
                <div class="col text-center">
                    <a href="{{ url('/informasi/berita') }}" class="btn btn-berita">
                        Berita Lainnya
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ALAMAT -->
    <section class="kontak-section position-relative">
        <!-- Background Image -->
        <img src="{{ asset('images/alamat-section.jpg') }}"
            alt="Gedung SMK Muhammadiyah 2 Tangerang"
            class="kontak-bg">

        <!-- Overlay -->
        <div class="kontak-overlay"></div>

        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">

                    <h2 class="kontak-title">Alamat & Kontak Kami</h2>
                    <p class="kontak-subtitle">
                        Hubungi kami untuk informasi lebih lanjut mengenai
                        SMK Muhammadiyah 2 Tangerang
                    </p>

                    <div class="kontak-info mt-4">
                        <p>
                            <strong>Alamat:</strong><br>
                            Jl. KH. Ahmad Dahlan No. XX, Tangerang, Banten
                        </p>
                        <p>
                            <strong>Telepon:</strong> (021) 1234 5678
                        </p>
                        <p>
                            <strong>Email:</strong> smkmuhammadiyah2@gmail.com
                        </p>
                    </div>

                    <div class="kontak-action mt-4">
                        <a href="https://maps.google.com" target="_blank"
                        class="btn btn-outline-light">
                            Lihat di Google Maps
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection