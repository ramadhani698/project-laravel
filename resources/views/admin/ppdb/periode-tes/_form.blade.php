<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">

        <div class="row g-4">

            <!-- Nama Periode -->
            <div class="col-12">
                <label for="nama_periode" class="form-label fw-semibold">Nama Periode</label>
                <input type="text"
                       name="nama_periode"
                       id="nama_periode"
                       class="form-control @error('nama_periode') is-invalid @enderror"
                       placeholder="Contoh: Periode Gelombang 1 - Tahun Ajaran 2026/2027"
                       value="{{ old('nama_periode', $periodeTes->nama_periode ?? '') }}">
                @error('nama_periode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rentang tanggal -->
            <div class="col-md-6">
                <label for="tanggal_buka_tes" class="form-label fw-semibold">Tanggal Buka Tes</label>
                <input type="date"
                       name="tanggal_buka_tes"
                       id="tanggal_buka_tes"
                       class="form-control @error('tanggal_buka_tes') is-invalid @enderror"
                       value="{{ old('tanggal_buka_tes', isset($periodeTes) ? $periodeTes->tanggal_buka_tes->format('Y-m-d') : '') }}">
                @error('tanggal_buka_tes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="tanggal_tutup_tes" class="form-label fw-semibold">Tanggal Tutup Tes</label>
                <input type="date"
                       name="tanggal_tutup_tes"
                       id="tanggal_tutup_tes"
                       class="form-control @error('tanggal_tutup_tes') is-invalid @enderror"
                       value="{{ old('tanggal_tutup_tes', isset($periodeTes) ? $periodeTes->tanggal_tutup_tes->format('Y-m-d') : '') }}">
                @error('tanggal_tutup_tes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Durasi otomatis (live preview, read-only) -->
            <div class="col-12">
                <div id="durasiInfo" class="d-none align-items-center gap-2 rounded-3 bg-light px-3 py-2 text-muted small">
                    <i class="fas fa-clock"></i>
                    <span>Durasi periode: <strong id="durasiTeks">-</strong></span>
                </div>
            </div>

            <!-- Status aktif -->
            <div class="col-12">
                <div class="form-check form-switch ps-0">
                    <div class="d-flex align-items-center gap-3">
                        <input class="form-check-input ms-0 @error('is_aktif') is-invalid @enderror"
                               type="checkbox"
                               role="switch"
                               name="is_aktif"
                               id="is_aktif"
                               style="width: 2.75rem; height: 1.5rem;"
                               value="1"
                               {{ old('is_aktif', $periodeTes->is_aktif ?? false) ? 'checked' : '' }}>
                        <label for="is_aktif" class="form-label fw-semibold mb-0">Aktifkan periode ini</label>
                    </div>
                    <div class="form-text ms-0">
                        Hanya boleh ada satu periode aktif dalam satu waktu. Jika sudah ada periode lain yang aktif, kamu perlu menonaktifkannya terlebih dahulu.
                    </div>
                    @error('is_aktif')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

    </div>
</div>

@push('scripts')
<script>
    (function () {
        const bukaInput = document.getElementById('tanggal_buka_tes');
        const tutupInput = document.getElementById('tanggal_tutup_tes');
        const durasiInfo = document.getElementById('durasiInfo');
        const durasiTeks = document.getElementById('durasiTeks');

        function hitungDurasi() {
            if (!bukaInput.value || !tutupInput.value) {
                durasiInfo.classList.add('d-none');
                return;
            }

            const buka = new Date(bukaInput.value);
            const tutup = new Date(tutupInput.value);
            const selisihHari = Math.round((tutup - buka) / (1000 * 60 * 60 * 24)) + 1;

            if (selisihHari <= 0) {
                durasiInfo.classList.add('d-none');
                return;
            }

            durasiTeks.textContent = selisihHari + ' hari';
            durasiInfo.classList.remove('d-none');
            durasiInfo.classList.add('d-flex');
        }

        bukaInput.addEventListener('change', hitungDurasi);
        tutupInput.addEventListener('change', hitungDurasi);
        hitungDurasi();
    })();
</script>
@endpush