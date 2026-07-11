@extends('admin.layout')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="{{ route('admin.ppdb.data-pendaftaran.index') }}" class="text-decoration-none small text-body-secondary d-block mb-1">
                &larr; Kembali ke daftar
            </a>
            <h4 class="mb-1 fw-semibold">{{ $formulir->nama_lengkap ?? '(belum diisi)' }}</h4>
            <p class="text-body-secondary mb-0">
                No. Pendaftaran: <strong>{{ $formulir->no_pendaftaran ?? '—' }}</strong> · {{ $formulir->pendaftar->email }}
            </p>
        </div>
        @php
            $statusBadge = [
                'draft' => 'bg-secondary-subtle text-secondary-emphasis',
                'menunggu_verifikasi' => 'bg-warning-subtle text-warning-emphasis',
                'terverifikasi' => 'bg-success-subtle text-success-emphasis',
            ];
        @endphp
        <span id="badge-status-formulir" class="badge fs-6 {{ $statusBadge[$formulir->status] }}">
            {{ str($formulir->status)->replace('_', ' ')->title() }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-coreui-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h6 class="fw-semibold mb-0">Biodata &amp; Keluarga</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <form method="POST" action="{{ route('admin.ppdb.data-pendaftaran.update', $formulir) }}">
                        @csrf @method('PUT')

                        <p class="text-uppercase small text-body-secondary fw-semibold mb-3">Biodata</p>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small">NISN</label>
                                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $formulir->nisn) }}">
                                @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">NIK</label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $formulir->nik) }}">
                                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">No. KK</label>
                                <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk', $formulir->no_kk) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">No. Akta Kelahiran</label>
                                <input type="text" name="no_akta" class="form-control" value="{{ old('no_akta', $formulir->no_akta) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $formulir->nama_lengkap) }}" required>
                                @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $formulir->tempat_lahir) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $formulir->tanggal_lahir?->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">-</option>
                                    <option value="Laki-laki" @selected(old('jenis_kelamin', $formulir->jenis_kelamin) === 'Laki-laki')>Laki-laki</option>
                                    <option value="Perempuan" @selected(old('jenis_kelamin', $formulir->jenis_kelamin) === 'Perempuan')>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="{{ old('asal_sekolah', $formulir->asal_sekolah) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $formulir->alamat) }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label small">Jurusan Pilihan</label>
                                <select name="jurusan_id" class="form-select">
                                    <option value="">-</option>
                                    @foreach($jurusanList as $j)
                                        <option value="{{ $j->id }}" @selected(old('jurusan_id', $formulir->jurusan_id) == $j->id)>{{ $j->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <p class="text-uppercase small text-body-secondary fw-semibold mb-3">Data Keluarga</p>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', $formulir->nama_ayah) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">NIK Ayah</label>
                                <input type="text" name="nik_ayah" class="form-control" value="{{ old('nik_ayah', $formulir->nik_ayah) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $formulir->pekerjaan_ayah) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', $formulir->nama_ibu) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">NIK Ibu</label>
                                <input type="text" name="nik_ibu" class="form-control" value="{{ old('nik_ibu', $formulir->nik_ibu) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', $formulir->pekerjaan_ibu) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">No. HP Orang Tua</label>
                                <input type="text" name="no_hp_ortu" class="form-control" value="{{ old('no_hp_ortu', $formulir->no_hp_ortu) }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h6 class="fw-semibold mb-0">Verifikasi Berkas</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    @php
                        $dokumenList = [
                            'ktp_ortu' => 'KTP Orang Tua',
                            'akta_kelahiran' => 'Akta Kelahiran',
                            'kartu_keluarga' => 'Kartu Keluarga',
                            'rapor_semester_akhir' => 'Rapor Semester Akhir',
                            'surat_keterangan_sehat' => 'Surat Keterangan Sehat',
                            'ijazah' => 'Ijazah',
                            'skl' => 'Surat Keterangan Lulus (SKL)',
                        ];
                        $statusBerkasBadge = [
                            'menunggu' => 'bg-secondary-subtle text-secondary-emphasis',
                            'valid' => 'bg-success-subtle text-success-emphasis',
                            'ditolak' => 'bg-danger-subtle text-danger-emphasis',
                        ];
                        $statusCardClass = [
                            'menunggu' => 'berkas-card-menunggu',
                            'valid' => 'berkas-card-valid',
                            'ditolak' => 'berkas-card-ditolak',
                        ];
                    @endphp

                    @foreach($dokumenList as $kode => $label)
                        <div class="border rounded-3 p-3 mb-3 {{ isset($berkas[$kode]) ? $statusCardClass[$berkas[$kode]->status_verifikasi] : '' }}"
                             id="berkas-card-{{ $kode }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="fw-medium small">{{ $label }}</div>
                                    @if(isset($berkas[$kode]))
                                        <a href="{{ $berkas[$kode]->url }}" target="_blank" class="small text-decoration-none">
                                            {{ $berkas[$kode]->nama_asli }}
                                        </a>
                                    @else
                                        <span class="small text-body-secondary">
                                            Belum diunggah
                                            @if(in_array($kode, ['ijazah', 'skl'])) <em>(Boleh menyusul)</em> @endif
                                        </span>
                                    @endif
                                </div>
                                @if(isset($berkas[$kode]))
                                    <span class="badge {{ $statusBerkasBadge[$berkas[$kode]->status_verifikasi] }}" data-badge="{{ $kode }}">
                                        {{ ucfirst($berkas[$kode]->status_verifikasi) }}
                                    </span>
                                @endif
                            </div>

                            @if(isset($berkas[$kode]))
                                <form method="POST"
                                    action="{{ route('admin.ppdb.data-pendaftaran.berkas.verifikasi', $berkas[$kode]) }}"
                                    class="verifikasi-form"
                                    data-kode="{{ $kode }}">
                                    @csrf @method('PATCH')
                                    <div class="d-flex gap-2 mb-2">
                                        <button type="submit" name="status_verifikasi" value="valid" class="btn btn-sm btn-outline-success flex-fill">Valid</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger flex-fill" data-coreui-toggle="collapse" data-coreui-target="#tolakForm{{ $berkas[$kode]->id }}">
                                            Tolak
                                        </button>
                                    </div>
                                    <div class="collapse" id="tolakForm{{ $berkas[$kode]->id }}">
                                        <textarea name="catatan_admin" class="form-control form-control-sm mb-2" rows="2" placeholder="Alasan penolakan, misal: foto buram / halaman salah..."></textarea>
                                        <button type="submit" name="status_verifikasi" value="ditolak" class="btn btn-sm btn-danger w-100">Konfirmasi Tolak</button>
                                    </div>
                                    <div data-catatan-wrap="{{ $kode }}">
                                        @if($berkas[$kode]->status_verifikasi === 'ditolak' && $berkas[$kode]->catatan_admin)
                                            <div class="small text-danger-emphasis mt-2">
                                                <em>Catatan: {{ $berkas[$kode]->catatan_admin }}</em>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusBerkasClass = {
        menunggu: 'bg-secondary-subtle text-secondary-emphasis',
        valid: 'bg-success-subtle text-success-emphasis',
        ditolak: 'bg-danger-subtle text-danger-emphasis',
    };

    const statusFormulirClass = {
        draft: 'bg-secondary-subtle text-secondary-emphasis',
        menunggu_verifikasi: 'bg-warning-subtle text-warning-emphasis',
        terverifikasi: 'bg-success-subtle text-success-emphasis',
    };

    const statusCardClass = {
        menunggu: 'berkas-card-menunggu',
        valid: 'berkas-card-valid',
        ditolak: 'berkas-card-ditolak',
    };

    document.querySelectorAll('.verifikasi-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitter = e.submitter; // tombol yang diklik: Valid / Konfirmasi Tolak
            const kode = form.dataset.kode;
            const formData = new FormData(form);
            formData.set('status_verifikasi', submitter.value);

            submitter.disabled = true;

            fetch(form.action, {
                method: 'POST', // @method('PATCH') di formData yang urus method spoofing
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message ?? 'Gagal menyimpan verifikasi.');
                    return;
                }

                // update badge dokumen
                const badge = document.querySelector(`[data-badge="${kode}"]`);
                if (badge) {
                    badge.className = 'badge ' + statusBerkasClass[data.status_verifikasi];
                    badge.textContent = data.status_verifikasi.charAt(0).toUpperCase() + data.status_verifikasi.slice(1);
                }

                // update warna kartu sesuai status terbaru
                const card = document.getElementById(`berkas-card-${kode}`);
                if (card) {
                    card.classList.remove('berkas-card-menunggu', 'berkas-card-valid', 'berkas-card-ditolak');
                    card.classList.add(statusCardClass[data.status_verifikasi]);
                }

                // update catatan penolakan
                const catatanWrap = document.querySelector(`[data-catatan-wrap="${kode}"]`);
                if (catatanWrap) {
                    catatanWrap.innerHTML = (data.status_verifikasi === 'ditolak' && data.catatan_admin)
                        ? `<div class="small text-danger-emphasis mt-2"><em>Catatan: ${data.catatan_admin}</em></div>`
                        : '';
                }

                // update badge status formulir di header (kalau berubah jadi terverifikasi)
                const badgeFormulir = document.getElementById('badge-status-formulir');
                if (badgeFormulir && data.status_formulir) {
                    badgeFormulir.className = 'badge fs-6 ' + statusFormulirClass[data.status_formulir];
                    badgeFormulir.textContent = data.status_formulir.replace('_', ' ').replace(/\b\w/g, c => c.toUpperCase());
                }

                // tutup collapse "Tolak" kalau lagi kebuka
                const collapseEl = form.querySelector('.collapse');
                if (collapseEl && collapseEl.classList.contains('show')) {
                    coreui.Collapse.getOrCreateInstance(collapseEl).hide();
                }
            })
            .catch(() => alert('Terjadi kesalahan, coba lagi.'))
            .finally(() => { submitter.disabled = false; });
        });
    });
});
</script>
@endpush