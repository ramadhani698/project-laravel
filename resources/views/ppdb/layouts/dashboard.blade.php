<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Pendaftar') - PPDB SMK Muhammadiyah 2 Tangerang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/ppdb/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/dashboard.css') }}">
    @stack('styles')
</head>
<body class="ppdb-dashboard">

    <header class="ppdb-header">
        <div class="brand">
            <svg viewBox="0 0 40 40" fill="none">
                <circle cx="20" cy="20" r="9" fill="#D4A017"/>
                <g stroke="#D4A017" stroke-width="2.4" stroke-linecap="round">
                    <line x1="20" y1="2" x2="20" y2="8"/>
                    <line x1="20" y1="32" x2="20" y2="38"/>
                    <line x1="2" y1="20" x2="8" y2="20"/>
                    <line x1="32" y1="20" x2="38" y2="20"/>
                    <line x1="7" y1="7" x2="11.5" y2="11.5"/>
                    <line x1="28.5" y1="28.5" x2="33" y2="33"/>
                    <line x1="33" y1="7" x2="28.5" y2="11.5"/>
                    <line x1="11.5" y1="28.5" x2="7" y2="33"/>
                </g>
            </svg>
            <div class="brand-text">
                <div class="school">SMK Muhammadiyah 2 Tangerang</div>
                <div class="unit">Dashboard Pendaftar PPDB</div>
            </div>
        </div>

        <div class="applicant">
            <div style="text-align:right;">
                <div class="name">{{ $pendaftar->nama_lengkap ?? '-' }}</div>
                <div class="batch">{{ $pendaftar->email ?? '-' }}</div>
            </div>
            <div class="avatar">
                {{ Str::of($pendaftar->nama_lengkap ?? '-')->explode(' ')->map(fn($w) => Str::substr($w, 0, 1))->take(2)->implode('') }}
            </div>
            <form method="POST" action="{{ route('ppdb.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>
    </header>

    <main class="ppdb-main">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>