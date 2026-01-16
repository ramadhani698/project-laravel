<nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="55">
        </a>

        <!-- HAMBURGER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVBAR MENU -->
        <div class="collapse navbar-collapse" id="navbarMenu">

            <!-- MENU TENGAH -->
            <ul class="navbar-nav mx-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <!-- Profil (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('profil/*') ? 'active' : '' }}"
                    href="#" role="button" data-bs-toggle="dropdown">
                        Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/profil/sejarah') }}">Sejarah Sekolah</a></li>
                        <li><a class="dropdown-item" href="{{ url('/profil/visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ url('/profil/kata-kepsek') }}">Kata Kepala Sekolah</a></li>
                    </ul>
                </li>

                <!-- Jurusan (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('jurusan/*') ? 'active' : '' }}"
                    href="#" role="button" data-bs-toggle="dropdown">
                        Jurusan
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($navJurusan as $jurusan)
                            <li>
                                <a href="{{ route('jurusan.show', $jurusan->slug) }}" class="dropdown-item">{{ $jurusan->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- Informasi Sekolah (Dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('informasi/*') ? 'active' : '' }}"
                    href="#" role="button" data-bs-toggle="dropdown">
                        Informasi Sekolah
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                        <li><a class="dropdown-item" href="{{ url('/informasi/berita') }}">Berita Terkini</a></li>
                        <li><a class="dropdown-item" href="{{ url('/informasi/sarpras') }}">Sarana dan Prasarana</a></li>
                        <li><a class="dropdown-item" href="{{ url('/informasi/gallery') }}">Galeri</a></li>
                    </ul>
                </li>

                <!-- Prestasi (Tanpa Dropdown) -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/prestasi') }}">Prestasi Siswa</a>
                </li>

            </ul>

            <!-- PPDB BUTTON -->
            <div class="d-flex">
                <a href="{{ url('/ppdb') }}" class="btn btn-ppdb">PPDB</a>
            </div>

        </div>
    </div>
</nav>
