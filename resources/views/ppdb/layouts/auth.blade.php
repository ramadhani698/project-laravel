<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB') - SMK Muhammadiyah 2 Tangerang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">

    <!-- Custom styles -->
     <link rel="stylesheet" href="{{ asset('css/ppdb/pendaftaran.css') }}">
    @stack('styles')
</head>
<body>

    <div class="auth-shell">
        <aside class="auth-brand">
            <svg class="sun-motif" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                @for ($i = 0; $i < 12; $i++)
                    <rect x="97" y="0" width="6" height="80" rx="3" fill="#D4A017"
                          transform="rotate({{ $i * 30 }} 100 100)"/>
                @endfor
                <circle cx="100" cy="100" r="42" fill="none" stroke="#D4A017" stroke-width="3"/>
            </svg>
            <svg class="sun-motif-bottom" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                @for ($i = 0; $i < 12; $i++)
                    <rect x="97" y="0" width="6" height="80" rx="3" fill="#ffffff"
                          transform="rotate({{ $i * 30 }} 100 100)"/>
                @endfor
                <circle cx="100" cy="100" r="42" fill="none" stroke="#ffffff" stroke-width="3"/>
            </svg>

            <div class="auth-brand-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span>PPDB<br>SMK Muhammadiyah 2</span>
            </div>

            <div class="auth-brand-body">
                @yield('brand-content')
            </div>

            <div class="auth-brand-foot">
                &copy; {{ date('Y') }} SMK Muhammadiyah 2 Tangerang
            </div>
        </aside>

        <main class="auth-form-panel">
            <div class="auth-form-wrap">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>