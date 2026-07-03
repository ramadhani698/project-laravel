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
            <a href="{{ url('/') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.home') ? 'active' : '' }}">Beranda</a>
            <a href="#" class="ppdb-nav-link">Persyaratan</a>
            <a href="#" class="ppdb-nav-link">Prosedur PPDB</a>
            <a href="#" class="ppdb-nav-link">Kontak</a>
            <a href="#" class="ppdb-nav-link">Pendaftaran</a>
            <a href="#" class="ppdb-nav-link">Login</a>
        </nav>
    </div>
</header>
