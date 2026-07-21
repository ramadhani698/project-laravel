@extends('ppdb.layouts.app')

@section('title', 'Kontak Kami - SMK Muhammadiyah')

@section('content')
<div class="kontak-page">

    {{-- HERO / BANNER --}}
    <section class="kontak-hero">
        <div class="container">
            <h1 class="kontak-hero__title">Kontak Kami</h1>
            <p class="kontak-hero__subtitle">Hubungi Panitia PPDB SMK Muhammadiyah</p>
            <p class="kontak-hero__desc">
                Punya pertanyaan seputar pendaftaran, persyaratan, atau jadwal PPDB?
                Silakan hubungi kami melalui kontak di bawah ini, atau kunjungi langsung
                lokasi sekolah pada peta yang tersedia.
            </p>
        </div>
    </section>

    {{-- KONTEN UTAMA: KARTU INFO + PETA --}}
    <section class="kontak-content">
        <div class="container kontak-grid">

            {{-- KARTU INFORMASI KONTAK --}}
            <div class="card kontak-card">
                <h2 class="card__title">Informasi Kontak</h2>

                <ul class="kontak-list">
                    <li class="kontak-list__item">
                        <span class="kontak-list__icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <div class="kontak-list__text">
                            <strong>Alamat</strong>
                            <p>{{ $kontak['alamat'] ?? 'Jl. Raden Fatah No. 100, Parung Serab, Kecamatan Ciledug, Kota Tangerang' }}</p>
                        </div>
                    </li>

                    <li class="kontak-list__item">
                        <span class="kontak-list__icon">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <div class="kontak-list__text">
                            <strong>Telepon / WhatsApp</strong>
                            <p>{{ $kontak['telepon'] ?? '+62 812-3456-7890' }}</p>
                        </div>
                    </li>

                    <li class="kontak-list__item">
                        <span class="kontak-list__icon">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <div class="kontak-list__text">
                            <strong>Email</strong>
                            <p>{{ $kontak['email'] ?? 'ppdb@namasekolah.sch.id' }}</p>
                        </div>
                    </li>

                    <li class="kontak-list__item">
                        <span class="kontak-list__icon">
                            <i class="fa-solid fa-clock"></i>
                        </span>
                        <div class="kontak-list__text">
                            <strong>Jam Layanan</strong>
                            <p>{{ $kontak['jam'] ?? 'Senin - Jumat, 08.00 - 15.00 WIB' }}</p>
                        </div>
                    </li>
                </ul>

                {{-- IKON MEDIA SOSIAL --}}
                <div class="kontak-social">
                    <h3 class="kontak-social__title">Ikuti Kami</h3>
                    <div class="kontak-social__icons">
                        <a href="{{ $kontak['instagram'] ?? '#' }}" target="_blank" class="kontak-social__icon" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="{{ $kontak['facebook'] ?? '#' }}" target="_blank" class="kontak-social__icon" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://wa.me/{{ $kontak['whatsapp'] ?? '6281234567890' }}" target="_blank" class="kontak-social__icon" aria-label="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                {{-- TOMBOL AKSI CEPAT --}}
                <div class="kontak-actions">
                    <a href="https://wa.me/{{ $kontak['whatsapp'] ?? '6281234567890' }}" target="_blank" class="btn btn--whatsapp">
                        <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                    </a>
                    <a href="mailto:{{ $kontak['email'] ?? 'ppdb@namasekolah.sch.id' }}" class="btn btn--email">
                        <i class="fa-solid fa-envelope"></i> Kirim Email
                    </a>
                </div>
            </div>

            {{-- PETA LOKASI --}}
            <div class="card kontak-map-card">
                <h2 class="card__title">Peta Lokasi Sekolah</h2>
                <div class="kontak-map">
                    <iframe
                        src="{{ $kontak['map_embed_url'] ?? 'https://www.google.com/maps?q=' . urlencode($kontak['alamat'] ?? 'Jl. Raden Fatah No. 100, Parung Serab, Kecamatan Ciledug, Kota Tangerang') . '&output=embed' }}"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection