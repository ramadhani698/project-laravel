@extends('frontend.layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<section class="hero-berita position-relative">
    <img src="{{ asset('images/breakingnews.jpg') }}" class="w-100 hero-img" alt="Berita Terkini">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <h1>Berita Terkini</h1>
        <p>Informasi dan kegiatan terbaru SMK Muhammadiyah 2 Tangerang</p>
    </div>
</section>


{{-- ================= SECTION BERITA (SAMA SEPERTI HOME) ================= --}}
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
            <div class="col-md-6 col-lg-4">
                <div class="berita-card">
                    <div class="berita-img">
                        <img src="{{ asset('uploads/berita/' . $berita->image) }}" alt="Berita">
                    </div>
                    <div class="berita-body">
                        <span class="berita-date">
                            {{ $berita->published_at?->translatedFormat('d F Y') }}
                        </span>
                        <h5 class="berita-title-card">
                            {{ $berita->title }}
                        </h5>
                        <p class="berita-desc">
                            {{ $berita->excerpt }}
                        </p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="berita-link">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col text-center">
                    <p class="text-muted">Data berita belum tersedia.</p>
                </div>
            @endforelse

        </div>

        {{-- ================= PAGINATION ================= --}}
        @if ($beritas->hasPages())
            <div class="row mt-5">
                <div class="col d-flex justify-content-center">
                    {{ $beritas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif

    </div>
</section>

@endsection
