<!-- Header / Navbar Section -->
<header class="ppdb-header" id="ppdbNavbar">
    <div class="ppdb-header-container">
        <a href="{{ url('/') }}" class="ppdb-logo-link">
            <div class="ppdb-logo-wrapper">
                <!-- Stylized SVG Muhammadiyah Sun Logo -->
                <svg width="45" height="45" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" stroke="#fbbf24" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <circle cx="50" cy="50" r="22" fill="#fbbf24"/>
                    <g stroke="#fbbf24" stroke-width="3.5" stroke-linecap="round">
                        <line x1="50" y1="12" x2="50" y2="20" />
                        <line x1="50" y1="80" x2="50" y2="88" />
                        <line x1="12" y1="50" x2="20" y2="50" />
                        <line x1="80" y1="50" x2="88" y2="50" />

                        <line x1="23" y1="23" x2="29" y2="29" />
                        <line x1="71" y1="71" x2="77" y2="77" />
                        <line x1="77" y1="23" x2="71" y2="29" />
                        <line x1="29" y1="71" x2="23" y2="77" />

                        <line x1="35" y1="15" x2="40" y2="24" />
                        <line x1="65" y1="85" x2="60" y2="76" />
                        <line x1="65" y1="15" x2="60" y2="24" />
                        <line x1="35" y1="85" x2="40" y2="76" />
                        <line x1="15" y1="35" x2="24" y2="40" />
                        <line x1="85" y1="65" x2="76" y2="60" />
                        <line x1="85" y1="35" x2="76" y2="40" />
                        <line x1="15" y1="65" x2="24" y2="60" />
                    </g>
                    <circle cx="50" cy="50" r="13" fill="#0f172a"/>
                    <path d="M46 50 Q50 44 54 50 Q50 56 46 50 Z" fill="#fbbf24"/>
                </svg>
                <div class="ppdb-logo-text-group">
                    <span class="ppdb-logo-title-text" style="font-size: 1.4rem;">SMK MUHAMMADIYAH 2 TANGERANG</span>
                </div>
            </div>
        </a>
        <!-- Navigation menus -->
        <nav class="ppdb-navbar-nav">
            <a href="{{ url('/') }}" class="ppdb-nav-link {{ request()->routeIs('ppdb.home') ? 'active' : '' }}">Beranda</a>
            <a href="#" class="ppdb-nav-link">Prosedur PPDB</a>
            <a href="#" class="ppdb-nav-link">Kontak</a>
            <a href="{{ route('ppdb.auth.daftar') }}" class="ppdb-nav-link">Pendaftaran</a>
            <a href="{{ route('ppdb.auth.login') }}" class="ppdb-nav-link">Login</a>
        </nav>
    </div>
</header>
