@extends('ppdb.layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ppdb/kontak.css') }}">
@endpush

@section('content')
    <div class="page-title">Kontak Kami</div>

    <div class="kontak-wrapper">
        {{-- Kolom kiri: info kontak --}}
        <div class="kontak-info">
            <h2>Informasi Kontak</h2>

            <div class="kontak-item">
                <span class="kontak-label">Alamat</span>
                <p>Jl. Contoh Raya No. 123, Serpong, Tangerang Selatan, Banten 15310</p>
            </div>

            <div class="kontak-item">
                <span class="kontak-label">Telepon / WhatsApp</span>
                <p>+62 812-3456-7890</p>
            </div>

            <div class="kontak-item">
                <span class="kontak-label">Email</span>
                <p>ppdb@namasekolah.sch.id</p>
            </div>

            <div class="kontak-item">
                <span class="kontak-label">Jam Layanan</span>
                <p>Senin – Jumat, 08.00 – 15.00 WIB</p>
            </div>

            <div class="kontak-tombol">
                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-whatsapp">Chat via WhatsApp</a>
                <a href="mailto:ppdb@namasekolah.sch.id" class="btn btn-email">Kirim Email</a>
            </div>

            <div class="kontak-sosmed">
                <span class="kontak-label">Media Sosial</span>
                <div class="sosmed-icons">
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        {{-- Kolom kanan: peta --}}
        <div class="kontak-map">
            <h2>Lokasi Sekolah</h2>
            <div class="map-frame">
                <iframe
                    src="https://www.google.com/maps?q=BSD%20Serpong&output=embed"
                    width="100%" height="320" style="border:0;" allowfullscreen loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

    {{-- Formulir kontak --}}
    <div class="kontak-form-wrapper">
        <h2>Ada Pertanyaan? Kirim Pesan</h2>

        <form class="kontak-form" onsubmit="return false;">
            <div class="form-row">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-row">
                <label for="kontak">Email / No. HP</label>
                <input type="text" id="kontak" name="kontak" placeholder="Masukkan email atau nomor HP" required>
            </div>

            <div class="form-row">
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" rows="4" placeholder="Tulis pertanyaan Anda di sini" required></textarea>
            </div>

            <button type="submit" class="btn btn-kirim">Kirim Pesan</button>
        </form>
    </div>
@endsection