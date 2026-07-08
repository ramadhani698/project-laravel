@extends('ppdb.layouts.auth')

@section('title', 'Atur Ulang Kata Sandi')

@section('brand-content')
    <h1>Hampir selesai!</h1>
    <p>Buat kata sandi baru yang mudah kamu ingat, minimal 8 karakter.</p>
@endsection

@section('content')
    <h2>Kata Sandi Baru</h2>
    <p class="subtitle">Masukkan kata sandi baru untuk akunmu</p>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3" style="font-size:0.85rem; border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.auth.lupa-password.reset.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi Baru</label>
            <div class="input-icon-group">
                <i class="ti ti-lock"></i>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Minimal 8 karakter" required>
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <div class="input-icon-group">
                <i class="ti ti-lock"></i>
                <input type="password" class="form-control"
                       id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi kata sandi baru" required>
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-ppdb-primary w-100">
            Simpan Kata Sandi Baru <i class="ti ti-check ms-1"></i>
        </button>
    </form>
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