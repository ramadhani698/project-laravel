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

            @forelse($prestasis as $index => $prestasi)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="prestasi-card">

                    {{-- Gambar Prestasi --}}
                    <div class="prestasi-image">
                        <img src="{{ asset('uploads/prestasi/'.$prestasi->image) }}" alt="{{ $prestasi->judul }}">
                    </div>

                    <h5>{{ $prestasi->judul }}</h5>

                    <div class="prestasi-badge">{{ $prestasi->juara }}</div>

                    <p class="prestasi-siswa">
                        Nama Siswa: <strong>{{ $prestasi->nama_siswa }}</strong>
                    </p>

                    <p class="prestasi-desc">
                        {{ $prestasi->deskripsi }}
                    </p>

                    <span class="prestasi-year">{{ $prestasi->tahun }}</span>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">Data prestasi belum ditambahkan.</p>
            </div>
            @endforelse

            {{-- Tambahkan data dummy lainnya --}}
        </div>

    </div>
</section>

@endsection
