<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Pendaftar') - PPDB SMK Muhammadiyah 2 Tangerang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/ppdb/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/wizard-tes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/kerjakan.css') }}">
    @stack('styles')
</head>
<body class="ppdb-dashboard">

    <header class="ppdb-header">
        <div class="brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SMK Muhammadiyah 2 Tangerang" class="brand-logo">
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