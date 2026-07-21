@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            {{ $jalur ? 'Edit Jalur Pendaftaran' : 'Tambah Jalur Pendaftaran' }}
        </h2>
        <a href="{{ route('admin.jalur-pendaftaran.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ $jalur ? route('admin.jalur-pendaftaran.update', $jalur) : route('admin.jalur-pendaftaran.store') }}"
                  method="POST">
                @csrf
                @if ($jalur)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Jalur <span class="text-danger">*</span></label>
                    <input type="text" name="nama_jalur"
                           value="{{ old('nama_jalur', $jalur->nama_jalur ?? '') }}"
                           placeholder="Contoh: Jalur Reguler"
                           class="form-control @error('nama_jalur') is-invalid @enderror">
                    @error('nama_jalur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" rows="3"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $jalur->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ikon</label>
                        <select name="icon" class="form-select">
                            @foreach (['reguler' => 'Reguler', 'prestasi' => 'Prestasi', 'tahfidz' => 'Tahfidz', 'yatim' => 'Yatim/Dhuafa'] as $val => $label)
                                <option value="{{ $val }}" {{ old('icon', $jalur->icon ?? '') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Warna</label>
                        <select name="warna" class="form-select">
                            @foreach (['hijau' => 'Hijau', 'amber' => 'Amber'] as $val => $label)
                                <option value="{{ $val }}" {{ old('warna', $jalur->warna ?? '') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Urutan</label>
                        <input type="number" name="urutan"
                               value="{{ old('urutan', $jalur->urutan ?? 0) }}"
                               class="form-control">
                    </div>
                </div>

                <div class="form-check border-top pt-3 mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                           {{ old('is_active', $jalur->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="is_active">
                        Aktifkan (tampil di halaman publik)
                    </label>
                </div>

                <div class="d-flex gap-2 border-top pt-3">
                    <button type="submit" class="btn btn-warning text-white fw-semibold px-4">
                        {{ $jalur ? 'Update Jalur' : 'Simpan Jalur' }}
                    </button>
                    <a href="{{ route('admin.jalur-pendaftaran.index') }}" class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection