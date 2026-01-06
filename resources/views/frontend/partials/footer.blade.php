<footer class="footer-section">
    <div class="container">
        <div class="row gy-4">

            <!-- Profil Sekolah -->
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMK Muhammadiyah 2 Tangerang" class="footer-logo">
                <h5 class="footer-title">SMK Muhammadiyah 2 Tangerang</h5>
                <p class="footer-text">
                    Sekolah kejuruan yang berkomitmen mencetak generasi
                    unggul, berkarakter, dan siap bersaing di dunia kerja.
                </p>
            </div>

            <!-- Menu Cepat -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Menu</h5>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/profil">Profil</a></li>
                    <li><a href="/jurusan">Jurusan</a></li>
                    <li><a href="/berita">Berita</a></li>
                    <li><a href="/kontak">Kontak</a></li>
                </ul>
            </div>

            <!-- Jurusan -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Program Keahlian</h5>
                <ul class="footer-links">
                    <li>Teknik Komputer dan Jaringan</li>
                    <li>Desain Komunikasi Visual</li>
                    <li>Manajemen Perkantoran</li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Kontak</h5>
                <ul class="footer-contact">
                    <li>📍 Tangerang, Banten</li>
                    <li>📞 (021) 123456</li>
                    <li>✉️ info@smkmuh2tng.sch.id</li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="footer-bottom text-center mt-4">
            <p>
                © {{ date('Y') }} SMK Muhammadiyah 2 Tangerang.
                All rights reserved.
            </p>
        </div>
    </div>
</footer>
