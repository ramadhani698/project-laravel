<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('coreui/css/style.min.css') }}">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- SIDEBAR (fixed) -->
    @include('admin.components.sidebar')

    <!-- WRAPPER UNTUK NAVBAR & KONTEN -->
    <div class="wrapper d-flex flex-column min-vh-100">

        <!-- NAVBAR -->
        @include('admin.components.navbar')

        <!-- KONTEN -->
        <div class="body flex-grow-1 px-3 pt-3">
            @yield('content')
        </div>

    </div>

    <script src="{{ asset('coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
