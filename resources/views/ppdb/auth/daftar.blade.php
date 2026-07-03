@extends('ppdb.layouts.auth')

@section('title', 'Daftar Akun')

@section('brand-content')
    <h1>Mulai langkah pertamamu menuju SMK Muhammadiyah 2 Tangerang</h1>
    <p>Buat akun untuk mendaftar sebagai calon peserta didik baru tahun ajaran 2026/2027.</p>

    <ul class="step-list">
        <li>
            <div class="step-num">1</div>
            <div class="step-text">
                <strong>Buat akun</strong>
                <span>Daftar dengan email &amp; nomor WhatsApp aktif</span>
            </div>
        </li>
        <li>
            <div class="step-num">2</div>
            <div class="step-text">
                <strong>Lengkapi data &amp; berkas</strong>
                <span>Isi biodata, data orang tua, dan unggah dokumen</span>
            </div>
        </li>
        <li>
            <div class="step-num">3</div>
            <div class="step-text">
                <strong>Tunggu hasil seleksi</strong>
                <span>Pantau status pendaftaranmu langsung dari dashboard</span>
            </div>
        </li>
    </ul>
@endsection

@section('content')
    <h2>Buat akun pendaftar</h2>
    <p class="subtitle">Sudah punya akun? <a href="{{ route('ppdb.auth.login') }}" class="text-decoration-none" style="color:var(--ppdb-green-700); font-weight:600;">Masuk di sini</a></p>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3" style="font-size:0.85rem; border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.auth.daftar.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama lengkap</label>
            <div class="input-icon-group">
                <i class="ti ti-user"></i>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                       id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                       placeholder="Sesuai akta kelahiran" required>
            </div>
        </div>

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
            <label for="no_hp" class="form-label">Nomor WhatsApp aktif</label>
            <div class="input-icon-group">
                <i class="ti ti-brand-whatsapp"></i>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                       id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="08xxxxxxxxxx" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata sandi</label>
            <div class="input-icon-group">
                <i class="ti ti-lock"></i>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Minimal 8 karakter" required>
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi kata sandi</label>
            <div class="input-icon-group">
                <i class="ti ti-lock"></i>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi kata sandi" required>
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="syarat" required>
            <label class="form-check-label" for="syarat" style="font-size:0.85rem; color:var(--ppdb-ink-soft);">
                Saya menyetujui <a href="#" style="color:var(--ppdb-green-700);">syarat &amp; ketentuan</a> pendaftaran PPDB
            </label>
        </div>

        <button type="submit" class="btn btn-ppdb-primary w-100">
            Buat akun <i class="ti ti-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="auth-switch mt-4">
        Sudah punya akun? <a href="{{ route('ppdb.auth.login') }}">Masuk di sini</a>
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
