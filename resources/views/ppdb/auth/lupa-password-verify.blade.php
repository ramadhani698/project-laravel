@extends('ppdb.layouts.auth')

@section('title', 'Lupa Kata Sandi')

@section('brand-content')
    <h1>Lupa kata sandi?</h1>
    <p>Tenang, kamu bisa atur ulang sendiri kok — cukup verifikasi data yang kamu daftarkan sebelumnya.</p>
@endsection

@section('content')
    <h2>Verifikasi Data Diri</h2>
    <p class="subtitle">Masukkan email dan no. HP yang kamu gunakan saat mendaftar</p>

    @if ($errors->any())
        <div class="alert alert-danger py-2 px-3" style="font-size:0.85rem; border-radius:10px;">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.auth.lupa-password.verify.store') }}" method="POST">
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

        <div class="mb-4">
            <label for="no_hp" class="form-label">No. HP</label>
            <div class="input-icon-group">
                <i class="ti ti-phone"></i>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                       id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="08xxxxxxxxxx" required>
            </div>
        </div>

        <button type="submit" class="btn btn-ppdb-primary w-100">
            Verifikasi <i class="ti ti-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="auth-switch">
        Sudah ingat kata sandi? <a href="{{ route('ppdb.auth.login') }}">Kembali ke masuk</a>
    </div>
@endsection