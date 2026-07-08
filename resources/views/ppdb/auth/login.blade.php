@extends('ppdb.layouts.auth')

@section('title', 'Masuk Akun')

@section('brand-content')
    <h1>Selamat datang kembali, calon siswa hebat!</h1>
    <p>Masuk untuk melanjutkan proses pendaftaran atau memantau status seleksimu.</p>

    <ul class="step-list">
        <li>
            <div class="step-num"><i class="ti ti-file-text" style="font-size:0.9rem;"></i></div>
            <div class="step-text">
                <strong>Lanjutkan formulir</strong>
                <span>Lengkapi data yang belum selesai</span>
            </div>
        </li>
        <li>
            <div class="step-num"><i class="ti ti-upload" style="font-size:0.9rem;"></i></div>
            <div class="step-text">
                <strong>Cek status berkas</strong>
                <span>Lihat status verifikasi dokumenmu</span>
            </div>
        </li>
        <li>
            <div class="step-num"><i class="ti ti-bell" style="font-size:0.9rem;"></i></div>
            <div class="step-text">
                <strong>Pantau pengumuman</strong>
                <span>Update jadwal tes &amp; hasil seleksi</span>
            </div>
        </li>
    </ul>
@endsection

@section('content')
    <h2>Masuk ke akun</h2>
    <p class="subtitle">Gunakan email dan kata sandi yang terdaftar</p>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3" style="font-size:0.85rem; border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.auth.login.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-icon-group">
                <i class="ti ti-mail"></i>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}"
                       placeholder="nama@email.com" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata sandi</label>
            <div class="input-icon-group">
                <i class="ti ti-lock"></i>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Masukkan kata sandi" required>
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember" style="font-size:0.85rem; color:var(--ppdb-ink-soft);">
                    Ingat saya
                </label>
            </div>
            <a href="{{ route('ppdb.auth.lupa-password.verify') }}" style="font-size:0.85rem; color:var(--ppdb-green-700); text-decoration:none; font-weight:600;">
                Lupa kata sandi?
            </a>
        </div>

        <button type="submit" class="btn btn-ppdb-primary w-100">
            Masuk <i class="ti ti-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="divider-text">atau</div>

    <div class="auth-switch">
        Belum punya akun? <a href="{{ route('ppdb.auth.daftar') }}">Daftar sekarang</a>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = btn.closest('.input-icon-group').querySelector('input');
            const icon = btn.querySelector('i');
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('ti-eye');
            icon.classList.toggle('ti-eye-off');
        });
    });
</script>
@endpush
