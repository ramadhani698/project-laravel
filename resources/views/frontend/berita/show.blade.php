@extends('frontend.layouts.app')

@section('title', $berita->title)

@section('content')
<section class="berita-detail-section">
    <div class="container">

        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <span>/</span>
            <a href="{{ url('/informasi/berita') }}">Berita</a>
            <span>/</span>
            <span class="active">{{ $berita->title }}</span>
        </nav>

        <!-- Judul -->
        <h1 class="berita-detail-title">
            {{ $berita->title }}
        </h1>

        <!-- Meta -->
        <div class="berita-detail-meta">
            <span>
                {{ $berita->published_at?->translatedFormat('d F Y') }}
            </span>
            <span class="dot">•</span>
            <span>SMK Muhammadiyah 2 Tangerang</span>
        </div>

        <!-- Image -->
        @if ($berita->image)
            <div class="berita-detail-image">
                <img src="{{ asset('uploads/berita/' . $berita->image) }}"
                     alt="{{ $berita->title }}">
            </div>
        @endif

        <!-- Content -->
        <article class="berita-detail-content">
            {!! $berita->content !!}
        </article>

        <!-- Back -->
        <div class="berita-detail-back">
            <a href="{{ url('/informasi/berita') }}">
                ← Kembali ke daftar berita
            </a>
        </div>

    </div>
</section>
@endsection
