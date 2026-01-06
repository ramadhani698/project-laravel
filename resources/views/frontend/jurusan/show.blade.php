@extends('frontend.layouts.app')

@section('title', $jurusan->name)

@section('content')

<!-- HEADER -->
<section class="page-header jurusan-header py-5 bg-light" style="margin-top: 80px">
    <div class="container text-center jurusan-header__content">
        <h1 class="fw-bold mb-3 jurusan-header__title">
            {{ $jurusan->name }}
        </h1>
        <p class="text-muted col-lg-8 mx-auto jurusan-header__subtitle">
            {{ $jurusan->short_description }}
        </p>
    </div>
</section>

<!-- DESKRIPSI JURUSAN -->
<section class="jurusan-about py-5">
    <div class="container">
        <div class="row align-items-center g-4 jurusan-about__row">
            <div class="col-md-6 jurusan-about__text">
                <h3 class="fw-bold text-success mb-3 jurusan-about__title">
                    Tentang Jurusan
                </h3>
                <p class="text-muted jurusan-about__description">
                    {{ $jurusan->about }}
                </p>
            </div>

            <div class="col-md-6 text-center jurusan-about__image-wrapper">
                <img 
                    src="{{ asset('uploads/jurusan/' . $jurusan->image) }}" 
                    alt="Kegiatan Jurusan {{ $jurusan->name }}"
                    class="img-fluid rounded-4 shadow jurusan-about__image"
                >
            </div>
        </div>
    </div>
</section>

<!-- KEPALA KOMPETENSI KEAHLIAN -->
<section class="jurusan-head py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center jurusan-head__content">
                <img 
                    src="{{ asset('uploads/jurusan_head/' . $jurusan->head->photo) }}" 
                    alt="Kepala Kompetensi Keahlian {{ $jurusan->name }}"
                    class="img-fluid rounded-circle mb-3 jurusan-head__photo"
                >
                <h4 class="fw-bold mb-1 jurusan-head__name">
                    {{ $jurusan->head->name }}
                </h4>
                <p class="text-muted mb-0 jurusan-head__position">
                    Kepala Kompetensi Keahlian {{ $jurusan->name }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- VISI & MISI JURUSAN -->
<section class="jurusan-visi-misi py-5">
    <div class="container">
        <div class="row g-4">
            
            <!-- VISI -->
            <div class="col-md-6 jurusan-visi">
                <div class="card h-100 border-0 shadow-sm rounded-4 jurusan-visi__card">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-success mb-3 jurusan-visi__title">
                            Visi Jurusan
                        </h4>
                        <p class="text-muted jurusan-visi__text">
                            {{ $jurusan->visiMisi->visi }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- MISI -->
            <div class="col-md-6 jurusan-misi">
                <div class="card h-100 border-0 shadow-sm rounded-4 jurusan-misi__card">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-success mb-3 jurusan-misi__title">
                            Misi Jurusan
                        </h4>
                        <ul class="text-muted ps-3 jurusan-misi__list">
                            @foreach ($jurusan->visiMisi->misi as $item)
                                <li class="jurusan-misi__item">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- GALERI KEGIATAN -->
<section class="jurusan-gallery py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4 jurusan-gallery__header">
            <h3 class="fw-bold jurusan-gallery__title">
                Kegiatan Jurusan {{ $jurusan->name }}
            </h3>
            <p class="text-muted jurusan-gallery__subtitle">
                Berbagai aktivitas dan praktik peserta didik
            </p>
        </div>

        <div class="row g-3 jurusan-gallery__grid">
            @foreach($jurusan->galleries as $gallery)
                <div class="col-md-4 jurusan-gallery__item">
                    <img 
                        src="{{ asset('uploads/jurusan_gallery/' . $gallery->image) }}" 
                        alt="Kegiatan Jurusan {{ $jurusan->name }}"
                        class="img-fluid rounded-4 shadow-sm jurusan-gallery__image"
                    >
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
