<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB') - SMK Muhammadiyah 2 Tangerang</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/ppdb/ppdb.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/prosedur.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ppdb/kontak.css') }}">
    
    @stack('styles')
</head>
<body data-bs-spy="scroll" data-bs-target="#ppdbNavbar" data-bs-offset="90" tabindex="0">

    @include('ppdb.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('ppdb.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
