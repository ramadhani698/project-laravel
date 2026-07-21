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

@push('styles')
<style>
    .container {
        max-width: 1160px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* HERO */
    .kontak-hero {
        background: #ffffff;
        border: 1px solid #e2e2e2;
        border-radius: 10px;
        padding: 36px 0;
        margin: 24px auto 20px;
        max-width: 1160px;
    }
    .kontak-hero__title {
        font-size: 28px;
        font-weight: 700;
        color: #1a3c2e;
        margin: 0 0 8px;
    }
    .kontak-hero__subtitle {
        font-size: 17px;
        font-weight: 600;
        color: #2d6a4f;
        margin: 0 0 10px;
    }
    .kontak-hero__desc {
        font-size: 15px;
        color: #555;
        max-width: 700px;
        line-height: 1.6;
        margin: 0;
    }

    /* GRID */
    .kontak-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: start;
        margin-bottom: 40px;
    }
    @media (max-width: 860px) {
        .kontak-grid {
            grid-template-columns: 1fr;
        }
    }

    /* CARD - background hijau senada navbar */
    .card {
        background: #146C43;
        border: 1px solid #e2e2e2;
        border-radius: 10px;
        padding: 28px;
    }
    .card__title {
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 20px;
    }

    /* LIST INFO KONTAK */
    .kontak-list {
        list-style: none;
        margin: 0 0 24px;
        padding: 0;
    }
    .kontak-list__item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }
    .kontak-list__item:last-child {
        border-bottom: none;
    }
    .kontak-list__icon {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }
    .kontak-list__text strong {
        display: block;
        font-size: 14px;
        color: #ffffff;
        margin-bottom: 3px;
    }
    .kontak-list__text p {
        margin: 0;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.5;
    }

    /* SOCIAL */
    .kontak-social {
        margin-bottom: 24px;
    }
    .kontak-social__title {
        font-size: 14px;
        font-weight: 700;
        color: #ffffff;
        margin: 0 0 12px;
    }
    .kontak-social__icons {
        display: flex;
        gap: 12px;
    }
    .kontak-social__icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 18px;
        transition: background .15s ease, color .15s ease;
    }
    .kontak-social__icon:hover {
        background: #ffffff;
        color: #146C43;
    }

    /* ACTIONS */
    .kontak-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        color: #fff;
    }
    .btn--whatsapp { background: #25D366; }
    .btn--whatsapp:hover { background: #1ebe57; }
    .btn--email { background: #ffffff; color: #146C43; }
    .btn--email:hover { background: #eaf4ee; }

    /* MAP */
    .kontak-map {
        border-radius: 8px;
        overflow: hidden;
        height: 380px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
@endpush