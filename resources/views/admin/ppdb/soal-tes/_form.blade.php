@csrf

<div class="row g-4">

    <!-- Tipe Soal -->
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tipe Soal</label>
        <select name="tipe_soal" id="tipe_soal"
                class="form-select @error('tipe_soal') is-invalid @enderror" required>
            <option value="">-- Pilih Tipe Soal --</option>
            <option value="akademik" {{ old('tipe_soal', $soalTe->tipe_soal ?? '') === 'akademik' ? 'selected' : '' }}>
                Akademik
            </option>
            <option value="kejuruan" {{ old('tipe_soal', $soalTe->tipe_soal ?? '') === 'kejuruan' ? 'selected' : '' }}>
                Kejuruan
            </option>
        </select>
        @error('tipe_soal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Jurusan (khusus kejuruan) -->
    <div class="col-md-6" id="wrapper_jurusan">
        <label class="form-label fw-semibold">Jurusan</label>
        <select name="jurusan_id" id="jurusan_id"
                class="form-select @error('jurusan_id') is-invalid @enderror">
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusans as $jurusan)
                <option value="{{ $jurusan->id }}" {{ (string) old('jurusan_id', $soalTe->jurusan_id ?? '') === (string) $jurusan->id ? 'selected' : '' }}>
                    {{ $jurusan->name }}
                </option>
            @endforeach
        </select>
        @error('jurusan_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Wajib diisi untuk soal tipe kejuruan.</div>
    </div>

    <!-- Pertanyaan -->
    <div class="col-12">
        <label class="form-label fw-semibold">Pertanyaan</label>
        <textarea name="pertanyaan" rows="3"
                  class="form-control @error('pertanyaan') is-invalid @enderror"
                  placeholder="Tulis pertanyaan di sini...">{{ old('pertanyaan', $soalTe->pertanyaan ?? '') }}</textarea>
        @error('pertanyaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Opsi Jawaban -->
    @foreach (['a', 'b', 'c', 'd'] as $opsi)
        <div class="col-md-6">
            <label class="form-label fw-semibold">Opsi {{ strtoupper($opsi) }}</label>
            <div class="input-group">
                <span class="input-group-text bg-light fw-bold" style="width: 42px; justify-content: center;">
                    {{ strtoupper($opsi) }}
                </span>
                <input type="text" name="opsi_{{ $opsi }}"
                       value="{{ old('opsi_' . $opsi, $soalTe->{'opsi_' . $opsi} ?? '') }}"
                       class="form-control @error('opsi_' . $opsi) is-invalid @enderror"
                       placeholder="Isi opsi {{ strtoupper($opsi) }}">
                @error('opsi_' . $opsi)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    @endforeach

    <!-- Kunci Jawaban -->
    <div class="col-12">
        <label class="form-label fw-semibold d-block mb-2">Kunci Jawaban</label>
        <div class="d-flex gap-2 flex-wrap">
            @foreach (['a', 'b', 'c', 'd'] as $opsi)
                @php $checked = old('kunci_jawaban', $soalTe->kunci_jawaban ?? '') === $opsi; @endphp
                <input type="radio" class="btn-check" name="kunci_jawaban" id="kunci_{{ $opsi }}"
                       value="{{ $opsi }}" {{ $checked ? 'checked' : '' }} autocomplete="off">
                <label class="btn btn-outline-success rounded-pill px-4" for="kunci_{{ $opsi }}">
                    {{ strtoupper($opsi) }}
                </label>
            @endforeach
        </div>
        @error('kunci_jawaban')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.ppdb.soal-tes.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary shadow-sm">
        <i class="fas fa-save me-1"></i> Simpan
    </button>
</div>

@push('scripts')
<script>
    function toggleJurusanField() {
        const tipe = document.getElementById('tipe_soal').value;
        const wrapper = document.getElementById('wrapper_jurusan');
        const select = document.getElementById('jurusan_id');

        if (tipe === 'kejuruan') {
            wrapper.style.display = 'block';
            select.disabled = false;
        } else {
            wrapper.style.display = 'none';
            select.value = '';
            select.disabled = true;
        }
    }

    document.getElementById('tipe_soal').addEventListener('change', toggleJurusanField);
    document.addEventListener('DOMContentLoaded', toggleJurusanField);
</script>
@endpush