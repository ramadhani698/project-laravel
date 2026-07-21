{{-- resources/views/admin/ppdb/hasil-seleksi/show.blade.php --}}
@extends('admin.layout')

@section('title', 'Detail Hasil Seleksi')

@section('content')
<div class="row">
    {{-- Info Pendaftar --}}
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header">
                <strong>Data Pendaftar</strong>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="40%">Nama Lengkap</th>
                        <td>: {{ $hasilSeleksi->formulirPendaftaran->nama_lengkap ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <td>: {{ $hasilSeleksi->formulirPendaftaran->no_pendaftaran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan Pilihan</th>
                        <td>: {{ $hasilSeleksi->formulirPendaftaran->jurusan->name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <strong>Hasil Nilai Tes</strong>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <h6 class="text-muted mb-1">Nilai Akademik</h6>
                        <h3 class="mb-0">
                            {{ $hasilSeleksi->nilai_akademik !== null ? number_format($hasilSeleksi->nilai_akademik, 2) : '-' }}
                        </h3>
                    </div>
                    <div class="col-6">
                        <h6 class="text-muted mb-1">Nilai Kejuruan</h6>
                        <h3 class="mb-0">
                            {{ $hasilSeleksi->nilai_kejuruan !== null ? number_format($hasilSeleksi->nilai_kejuruan, 2) : '-' }}
                        </h3>
                    </div>
                </div>

                @if($hasilSeleksi->nilai_akademik === null && $hasilSeleksi->nilai_kejuruan === null)
                    <div class="alert alert-warning mt-3 mb-0">
                        Peserta belum menyelesaikan tes online.
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Form Update Status --}}
    <div class="col-md-7">
        <div class="card mb-4">
            <div class="card-header">
                <strong>Keputusan Kelulusan</strong>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.ppdb.hasil-seleksi.update', $hasilSeleksi) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                        <select name="status_kelulusan" id="status_kelulusan" class="form-select" required>
                            <option value="menunggu" {{ $hasilSeleksi->status_kelulusan === 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>
                            <option value="lulus" {{ $hasilSeleksi->status_kelulusan === 'lulus' ? 'selected' : '' }}>
                                Lulus
                            </option>
                            <option value="tidak_lulus" {{ $hasilSeleksi->status_kelulusan === 'tidak_lulus' ? 'selected' : '' }}>
                                Tidak Lulus
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pengumuman" class="form-label">Tanggal Pengumuman</label>
                        <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman"
                               class="form-control"
                               value="{{ old('tanggal_pengumuman', $hasilSeleksi->tanggal_pengumuman?->format('Y-m-d')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="catatan_admin" class="form-label">Catatan Admin (opsional)</label>
                        <textarea name="catatan_admin" id="catatan_admin" rows="4"
                                  class="form-control">{{ old('catatan_admin', $hasilSeleksi->catatan_admin) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.ppdb.hasil-seleksi.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Keputusan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection