@extends('frontend.layouts.app')

@section('title', 'Kata Kepala Sekolah')

@section('content')

@if ($principalMessage)

    <!-- PAGE HEADER -->
    <section class="kk-page-header">
        <div class="kk-container kk-text-center">
            <h1 class="kk-title">Kata Kepala Sekolah</h1>

            <img 
                src="{{ $principalMessage->header_image
                    ? asset('uploads/principal-message/header-image/'.$principalMessage->header_image)
                    : asset('images/smk.jpg') }}"
                alt="Kepala Sekolah"
                class="kk-header-image"
            >
        </div>
    </section>

    <!-- CONTENT -->
    <section class="kk-section">
        <div class="kk-container">
            <div class="kk-grid">

                <!-- FOTO KEPALA SEKOLAH -->
                <div class="kk-photo-wrapper">
                    <img 
                        src="{{ $principalMessage->photo
                            ? asset('uploads/principal-message/photo/'.$principalMessage->photo)
                            : asset('images/kepsek.jpg') }}"
                        alt="Foto Kepala Sekolah"
                        class="kk-photo"
                    >
                </div>

                <!-- SAMBUTAN -->
                <div class="kk-content">
                    <h3 class="kk-greeting">
                        {{ $principalMessage->greeting ?? 'Assalamu’alaikum Warahmatullahi Wabarakatuh' }}
                    </h3>

                    <div class="kk-text">
                        {!! nl2br(e($principalMessage->content)) !!}
                    </div>

                    <p class="kk-position">
                        {{ $principalMessage->position ?? 'Kepala Sekolah' }}
                    </p>
                    <p class="kk-name">
                        {{ $principalMessage->nama ?? '-' }}
                    </p>
                </div>

            </div>
        </div>
    </section>

@else

    <!-- JIKA DATA BELUM ADA -->
    <section class="kk-section">
        <div class="kk-container kk-text-center">
            <p>Data kata kepala sekolah belum tersedia.</p>
        </div>
    </section>

@endif

@endsection
