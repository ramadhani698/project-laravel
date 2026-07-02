@extends('frontend.layouts.app')

@section('title', 'Kata Kepala Sekolah')

@section('content')

@if ($principalMessage)

<div class="kk-page">

    {{-- HERO --}}
    <div class="kk-hero">
        <img
            src="{{ $principalMessage->header_image
                ? Storage::url('principal-message/header-image/'.$principalMessage->header_image)
                : Storage::url('images/smk.jpg') }}"
            alt="Kepala Sekolah"
            class="kk-hero-img"
            loading="lazy"
        >
        <div class="kk-hero-overlay">
            <span class="kk-eyebrow">Sambutan</span>
            <h1 class="kk-hero-title">Kata Kepala Sekolah</h1>
        </div>
    </div>

    {{-- CONTENT --}}
    <section class="kk-section">
        <div class="kk-container">
            <div class="kk-letter">

                {{-- FOTO --}}
                <div class="kk-portrait">
                    <div class="kk-portrait-frame">
                        <img
                            src="{{ $principalMessage->photo
                                ? Storage::url('principal-message/photo/'.$principalMessage->photo)
                                : Storage::url('images/kepsek.jpg') }}"
                            alt="Foto Kepala Sekolah"
                            class="kk-photo"
                            loading="lazy"
                        >
                    </div>
                    <p class="kk-portrait-caption">
                        {{ $principalMessage->nama ?? '-' }}<br>
                        <span>{{ $principalMessage->position ?? 'Kepala Sekolah' }}</span>
                    </p>
                </div>

                {{-- SAMBUTAN --}}
                <div class="kk-message">
                    <span class="kk-quote-mark" aria-hidden="true">
                        <svg viewBox="0 0 48 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.4 0C6.4 4.8 0 13.2 0 22.8 0 30 4.8 36 12 36c6 0 10.8-4.8 10.8-10.8 0-6-4.2-9.6-9.6-9.6-.6 0-1.2 0-1.8.6C12.6 9.6 16.2 4.2 21.6 1.2L14.4 0Zm25.2 0C31.6 4.8 25.2 13.2 25.2 22.8c0 7.2 4.8 13.2 12 13.2 6 0 10.8-4.8 10.8-10.8 0-6-4.2-9.6-9.6-9.6-.6 0-1.2 0-1.8.6C37.8 9.6 41.4 4.2 46.8 1.2L39.6 0Z" fill="currentColor"/>
                        </svg>
                    </span>

                    <h3 class="kk-greeting">
                        {{ $principalMessage->greeting ?? 'Assalamu’alaikum Warahmatullahi Wabarakatuh' }}
                    </h3>

                    <div class="kk-text">
                        {!! nl2br(e($principalMessage->content)) !!}
                    </div>

                    <div class="kk-signature">
                        <span class="kk-signature-rule" aria-hidden="true"></span>
                        <p class="kk-name">{{ $principalMessage->nama ?? '-' }}</p>
                        <p class="kk-position">{{ $principalMessage->position ?? 'Kepala Sekolah' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

@else

<section class="kk-section">
    <div class="kk-container kk-text-center">
        <p class="kk-empty">Data kata kepala sekolah belum tersedia.</p>
    </div>
</section>

@endif

@endsection