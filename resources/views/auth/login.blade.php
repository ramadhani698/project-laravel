<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Admin Login">
    <meta name="author" content="CoreUI">
    <title>Login Admin</title>

    <!-- CoreUI Assets -->
    <link rel="stylesheet" href="{{ asset('coreui/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('coreui/css/vendors/simplebar.css') }}">
    <link href="{{ asset('coreui/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('coreui/css/examples.css') }}" rel="stylesheet">
    <script src="{{ asset('coreui/js/config.js') }}"></script>
    <script src="{{ asset('coreui/js/color-modes.js') }}"></script>
</head>

<body>
    <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card-group d-block d-md-flex row">
                        <!-- FORM LOGIN -->
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">

                                <h1>Login</h1>
                                <p class="text-body-secondary">Sign in to your account</p>

                                <!-- Status Pesan -->
                                @if (session('status'))
                                    <div class="alert alert-info">{{ session('status') }}</div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- EMAIL -->
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                                            </svg>
                                        </span>
                                        <input class="form-control @error('email') is-invalid @enderror"
                                            type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Email" required autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                                            </svg>
                                        </span>
                                        <input class="form-control @error('password') is-invalid @enderror"
                                            type="password" name="password" placeholder="Password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="mb-3">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        <label for="remember_me">Remember me</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">
                                                Login
                                            </button>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="col-6 text-end">
                                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                    Forgot password?
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!-- SIDEBAR KANAN -->
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>Welcome!</h2>
                                    <p>Silakan login untuk mengakses dashboard admin.</p>
                                </div>
                            </div>
                        </div>

                    </div><!-- END card-group -->

                </div>
            </div>
        </div>
    </div>

    <!-- CoreUI JS -->
    <script src="{{ asset('coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('coreui/vendors/simplebar/js/simplebar.min.js') }}"></script>

</body>

</html>
