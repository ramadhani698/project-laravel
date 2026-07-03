@extends('ppdb.layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Banner / Hero Section -->
    <section class="ppdb-hero-section">
        <div class="ppdb-hero-container">
            <!-- Center: Texts & Badges -->
            <div class="ppdb-hero-center">
                <div class="ppdb-telah-dibuka-badge">SPMB ONLINE</div>
                <h1 class="ppdb-hero-main-title">SPMB</h1>
                <h2 class="ppdb-hero-sub-title">SMK MUHAMMADIYAH 2 TANGERANG</h2>
                <div class="ppdb-hero-academic-year">TA. 2026 - 2027</div>

                <div class="ppdb-registration-date-box">
                    <span class="ppdb-date-label">GELOMBANG PENDAFTARAN</span>
                    <span class="ppdb-date-value">TELAH DIBUKA SEJAK OKTOBER 2025</span>
                </div>
            </div>
            <!-- Right: QR Code and Social Media Info -->
            <div class="ppdb-hero-right">
                <!-- Mini Logo -->
                <div class="ppdb-mini-logo">
                    <div class="ppdb-mini-logo-text">SMK MUHAMMADIYAH 2 TANGERANG</div>
                    <div class="ppdb-mini-logo-sub">KOTA TANGERANG</div>
                </div>

                <!-- Social media & info badges -->
                <div class="ppdb-social-badges">
                    <div class="ppdb-badge-row">
                        <a href="https://instagram.com/smkmudatangerang" target="_blank" class="ppdb-contact-pill instagram">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                            @smkmudatangerang
                        </a>
                        <a href="https://wa.me/628176988475" target="_blank" class="ppdb-contact-pill whatsapp">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-11.236c-.139-.233-.51-.371-1.066-.649-.556-.278-2.63-1.299-3.037-1.448-.407-.148-.704-.223-.999.222-.296.445-1.148 1.448-1.408 1.745-.259.296-.519.334-1.075.056-.556-.278-2.348-.865-4.471-2.759-1.652-1.473-2.766-3.292-3.09-3.848-.324-.556-.035-.856.243-1.133.25-.25.556-.649.834-.973.278-.324.37-.556.556-.927.185-.371.092-.695-.046-.973-.139-.278-1.205-2.902-1.653-3.985-.436-1.053-.878-.909-1.205-.925-.313-.016-.671-.02-1.03-.02s-.94.135-1.43.666c-.49.531-1.874 1.832-1.874 4.469s1.921 5.187 2.19 5.545c.269.358 3.783 5.776 9.176 8.106 1.282.554 2.284.884 3.064 1.131 1.289.41 2.463.353 3.392.214 1.036-.154 2.63-.829 3.002-1.625.372-.796.372-1.48.26-1.625-.112-.145-.409-.233-.966-.511z"/>
                            </svg>
                            0817-6988-475
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Major Levels Bar -->
        <div class="ppdb-hero-levels-bar">
            <span>Teknik Komputer & Jaringan (TKJ) - Desain Komunikasi Visual (DKV) - Manajemen Perkantoran dan Layanan Bisnis (MPLB)</span>
        </div>
    </section>

    <!-- Welcome / Main Info Content Section -->
    <section class="ppdb-welcome-content">
        <div class="ppdb-welcome-container">
            <h2 class="ppdb-welcome-heading">Selamat datang di halaman Sistem Penerimaan Murid Baru (SPMB) SMK Muhammadiyah 2 Tangerang TA. 2026-2027</h2>

            <p class="ppdb-welcome-text">
                Untuk memulai pendaftaran silahkan klik Menu <a href="#" class="ppdb-link-highlight">"Pendaftaran"</a>, atau klik Menu <a href="#" class="ppdb-link-highlight">"Prosedur SPMB"</a> untuk informasi lengkap seputar alur dan berkas pendaftaran.
            </p>

            <p class="ppdb-welcome-text">
                Notifikasi dan pemberitahuan informasi resmi pada proses pendaftaran akan kami kirimkan melalui:<br>
                Whatsapp (<span class="ppdb-text-highlight">0817-6988-475</span>)
            </p>

            <p class="ppdb-welcome-text">
                Untuk informasi lebih lanjut dan konsultasi program keahlian, kunjungi kami di Sekretariat SPMB SMK Muhammadiyah 2 Tangerang (Ruang Humas dan Pelayanan SPMB).
            </p>

            <p class="ppdb-welcome-text address-section">
                <strong>Alamat:</strong> Jl. Raden Fatah RT 01/RW 10 No. 100, Kel. Parung Serab, Kec. Ciledug, Kota Tangerang, Banten<br>
                <strong>Telp/WA:</strong> 0817-6988-475<br>
                <strong>Website:</strong> <a href="http://smkmudatangerang.sch.id" target="_blank" class="ppdb-link-highlight">http://smkmudatangerang.sch.id</a>,
                <strong>Email:</strong> <a href="mailto:smkmudatang@gmail.com" class="ppdb-link-highlight">smkmudatang@gmail.com</a>
            </p>
        </div>
    </section>
@endsection
