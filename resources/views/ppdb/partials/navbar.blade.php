<!-- Header / Navbar Section -->
<header class="ppdb-header" id="ppdbNavbar">
    <div class="ppdb-header-container">
        <a href="{{ url('/') }}" class="ppdb-logo-link">
            <div class="ppdb-logo-wrapper">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="ppdb-logo-image">
            </div>
        </a>
        <!-- Navigation menus -->
        <nav class="ppdb-navbar-nav">
            <a href="{{ route('ppdb.home') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('ppdb.persyaratan') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.persyaratan') ? 'active' : '' }}">Persyaratan</a>
            <a href="{{ route('ppdb.prosedur') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.prosedur') ? 'active' : '' }}">Prosedur PPDB</a>
            <a href="{{ route('ppdb.kontak') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.kontak') ? 'active' : '' }}">Kontak</a>
            <a href="{{ route('ppdb.auth.daftar') }}" class="ppdb-nav-link">Pendaftaran</a>
            <a href="{{ route('ppdb.auth.login') }}" class="ppdb-nav-link">Login</a>
        </nav>
    </div>
</header>
