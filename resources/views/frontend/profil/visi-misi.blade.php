@extends('frontend.layouts.app')

@section('title', 'Visi & Misi')

@section('content')

<section class="container py-5 vm-section" style="margin-top: 70px;">

    {{-- HERO: foto sebagai background --}}
    <div class="vm-hero" data-aos="fade-in">
        <img
            src="{{ Storage::url('vision/'.$vision->image) }}"
            alt="Visi dan Misi Sekolah"
            class="vm-hero-img"
            loading="lazy"
        >
        <div class="vm-hero-overlay">
            <span class="vm-eyebrow">Tentang Kami</span>
            <h1 class="vm-hero-title">Visi &amp; Misi Sekolah</h1>
            <p class="vm-hero-desc">
                Arah yang kami tuju, dan langkah-langkah nyata yang kami tempuh untuk mencapainya.
            </p>
        </div>
    </div>

    {{-- VISI & MISI: dua kotak sejajar --}}
    <div class="vm-grid">

        {{-- VISI --}}
        <div class="vm-card vm-card-visi" data-aos="fade-up" data-aos-delay="100">
            <div class="vm-card-icon">
                <i class="fas fa-compass"></i>
            </div>
            <span class="vm-card-eyebrow">Visi Kami</span>
            <h3 class="vm-card-title">Visi</h3>
            <p class="vm-card-text">
                {{ $vision->vision ?? 'Visi belum tersedia.' }}
            </p>
        </div>

        {{-- MISI --}}
        <div class="vm-card vm-card-misi" data-aos="fade-up" data-aos-delay="200">
            <div class="vm-card-icon">
                <i class="fas fa-route"></i>
            </div>
            <span class="vm-card-eyebrow">Langkah Kami</span>
            <h3 class="vm-card-title">Misi</h3>

            <ol class="vm-card-list">
                @forelse($vision->mission ?? [] as $item)
                    <li>
                        <span class="vm-card-list-num">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <span>{{ $item }}</span>
                    </li>
                @empty
                    <li><span>Misi belum tersedia.</span></li>
                @endforelse
            </ol>
        </div>

    </div>

</section>

@endsection