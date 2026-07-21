@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">
            {{ $dokumen ? 'Edit Dokumen Persyaratan' : 'Tambah Dokumen Persyaratan' }}
        </h2>
        <a href="{{ route('admin.persyaratan.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ $dokumen ? route('admin.persyaratan.update', $dokumen) : route('admin.persyaratan.store') }}"
                  method="POST">
                @csrf
                @if ($dokumen)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="nama_dokumen"
                           value="{{ old('nama_dokumen', $dokumen->nama_dokumen ?? '') }}"
                           placeholder="Contoh: KTP Orang Tua"
                           class="form-control @error('nama_dokumen') is-invalid @enderror">
                    @error('nama_dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                              placeholder="Opsional, contoh: Fotokopi dilegalisir"
                              class="form-control">{{ old('keterangan', $dokumen->keterangan ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Urutan</label>
                        <input type="number" name="urutan"
                               value="{{ old('urutan', $dokumen->urutan ?? 0) }}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Maksimal Ukuran (KB)</label>
                        <input type="number" name="maksimal_ukuran_kb"
                               value="{{ old('maksimal_ukuran_kb', $dokumen->maksimal_ukuran_kb ?? 2048) }}"
                               class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Format Diizinkan</label>
                    @php
                        $formatTerpilih = old('format_diizinkan', $dokumen->format_diizinkan ?? ['jpg', 'jpeg', 'pdf']);
                    @endphp
                    <div class="border rounded p-3 bg-light d-flex gap-4">
                        @foreach (['jpg', 'jpeg', 'png', 'pdf'] as $format)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="format_diizinkan[]"
                                       value="{{ $format }}" id="format_{{ $format }}"
                                       {{ in_array($format, $formatTerpilih) ? 'checked' : '' }}>
                                <label class="form-check-label" for="format_{{ $format }}">
                                    {{ strtoupper($format) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-4 border-top pt-3 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="wajib" value="1" id="wajib"
                               {{ old('wajib', $dokumen->wajib ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium" for="wajib">Wajib diisi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                               {{ old('is_active', $dokumen->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium" for="is_active">Aktifkan (tampil di halaman publik)</label>
                    </div>
                </div>

                <div class="d-flex gap-2 border-top pt-3">
                    <button type="submit" class="btn btn-warning text-white fw-semibold px-4">
                        {{ $dokumen ? 'Update Dokumen' : 'Simpan Dokumen' }}
                    </button>
                    <a href="{{ route('admin.persyaratan.index') }}" class="btn btn-outline-secondary px-4">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection