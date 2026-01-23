@extends('frontend.layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-prestasi position-relative">
    <img src="{{ asset('images/hero-prestasi.jpg') }}" class="w-100 hero-img" alt="Prestasi Siswa">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <h1>Prestasi Siswa</h1>
        <p>Apresiasi atas pencapaian dan prestasi siswa SMK Muhammadiyah 2 Tangerang</p>
    </div>
</section>


{{-- ================= PRESTASI SISWA ================= --}}
<section class="prestasi-section py-5">
    <div class="container">

        {{-- Judul --}}
        <div class="row mb-5 text-center">
            <div class="col">
                <h2 class="prestasi-title">Daftar Prestasi Siswa</h2>
                <p class="prestasi-subtitle">
                    Prestasi akademik dan non-akademik yang membanggakan
                </p>
            </div>
        </div>

        <div class="row g-4">

            {{-- Prestasi 1 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="prestasi-card">

                    {{-- Gambar Prestasi --}}
                    <div class="prestasi-image">
                        <img src="{{ asset('images/siswa-prestasi.jpg') }}" alt="Prestasi Siswa">
                    </div>

                    <h5>Lomba Desain Grafis Tingkat Kabupaten</h5>

                    <div class="prestasi-badge">Juara 1</div>

                    <p class="prestasi-siswa">
                        Nama Siswa: <strong>Siti Aisyah</strong>
                    </p>

                    <p class="prestasi-desc">
                        Meraih juara pertama dalam lomba desain grafis antar SMK
                        se-Kabupaten Tangerang tahun 2025.
                    </p>

                    <span class="prestasi-year">2025</span>
                </div>
            </div>

            {{-- Prestasi 2 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="prestasi-card">

                    {{-- Gambar Prestasi --}}
                    <div class="prestasi-image">
                        <img src="{{ asset('images/siswa-prestasi-2.jpg') }}" alt="Prestasi Siswa">
                    </div>

                    <h5>Lomba Desain Grafis Tingkat Kabupaten</h5>

                    <div class="prestasi-badge">Juara 1</div>

                    <p class="prestasi-siswa">
                        Nama Siswa: <strong>Muhammad Rizky</strong>
                    </p>

                    <p class="prestasi-desc">
                        Meraih juara pertama dalam lomba desain grafis antar SMK
                        se-Kabupaten Tangerang tahun 2025.
                    </p>

                    <span class="prestasi-year">2025</span>
                </div>
            </div>

            {{-- Prestasi 3 --}}
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="prestasi-card">

                    {{-- Gambar Prestasi --}}
                    <div class="prestasi-image">
                        <img src="{{ asset('images/siswa-prestasi-3.jpg') }}" alt="Prestasi Siswa">
                    </div>

                    <h5>Lomba Desain Grafis Tingkat Kabupaten</h5>

                    <div class="prestasi-badge">Juara 1</div>

                    <p class="prestasi-siswa">
                        Nama Siswa: <strong>Fatimah Az-Zahra</strong>
                    </p>

                    <p class="prestasi-desc">
                        Meraih juara pertama dalam lomba desain grafis antar SMK
                        se-Kabupaten Tangerang tahun 2025.
                    </p>

                    <span class="prestasi-year">2025</span>
                </div>
            </div>

            {{-- Tambahkan data dummy lainnya --}}
        </div>

    </div>
</section>

@endsection
