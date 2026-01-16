@extends('frontend.layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-galeri position-relative">
    <img src="{{ asset('images/hero-galeri.jpg') }}" class="w-100 hero-img" alt="Galeri Sekolah">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <h1>Galeri Sekolah</h1>
        <p>Dokumentasi kegiatan dan fasilitas SMK Muhammadiyah 2 Tangerang</p>
    </div>
</section>


{{-- ================= GALERI ================= --}}
<section class="galeri-section py-5">
    <div class="container">

        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="galeri-title">Galeri Kegiatan</h2>
                <p class="galeri-subtitle">
                    Momen terbaik kegiatan dan aktivitas sekolah
                </p>
            </div>
        </div>

        <div class="row g-4">

            {{-- Maksimal 9 item per halaman --}}
            @for ($i = 1; $i <= 9; $i++)
            <div class="col-md-6 col-lg-4">
                <div class="galeri-card"
                    data-bs-toggle="modal"
                    data-bs-target="#galeriModal"
                    data-image="{{ asset('images/berita.jpg') }}"
                    data-title="Kegiatan Sekolah {{ $i }}"
                    data-description="Kegiatan ini merupakan dokumentasi aktivitas siswa dalam rangka pengembangan karakter dan kebersamaan.">
                    <img src="{{ asset('images/berita'.'.jpg') }}"
                         alt="Galeri {{ $i }}">

                    <div class="galeri-overlay">
                        <h5>Kegiatan Sekolah {{ $i }}</h5>
                    </div>
                </div>
            </div>
            @endfor

        </div>

        {{-- ================= PAGINATION ================= --}}
        <div class="row mt-5">
            <div class="col d-flex justify-content-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link">Sebelumnya</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Selanjutnya</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        {{-- ================= MODAL GALERI ================= --}}
        <div class="modal fade" id="galeriModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="galeriModalTitle">Judul Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <img id="galeriModalImage"
                            src=""
                            class="img-fluid rounded"
                            alt="Preview Galeri">
                        <p id="galeriModalDescription" class="text-muted">
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

@endsection


