@extends('frontend.layouts.app')

@section('title', 'Visi & Misi')

@section('content')

<section class="vm-page-header">
    <div class="vm-container vm-text-center">
        <h1 class="vm-title">Visi & Misi Sekolah</h1>

        <img 
            src="{{ $vision->image_url }}" 
            alt="Visi dan Misi Sekolah"
            class="vm-header-image"
        >
    </div>
</section>

<section class="vm-section">
    <div class="vm-container">
        <div class="vm-grid">

            <!-- VISI -->
            <div class="vm-col">
                <div class="vm-card">
                    <div class="vm-card-body">
                        <h3 class="vm-card-title">Visi</h3>
                        <p class="vm-text">
                            {{ $vision->vision ?? 'Visi belum tersedia.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- MISI -->
            <div class="vm-col">
                <div class="vm-card">
                    <div class="vm-card-body">
                        <h3 class="vm-card-title">Misi</h3>
                        <ul class="vm-list">
                            @forelse($vision->mission ?? [] as $item)
                                <li>{{ $item }}</li>
                            @empty
                                <li>Misi belum tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
