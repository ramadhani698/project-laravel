<div class="step-panel active" data-step="1">
    <h2>Biodata diri</h2>
    <p class="hint">Isi data diri kamu sesuai dokumen resmi.</p>
    <div class="row2">
        <div class="field">
            <label>NISN</label>
            <input placeholder="10 digit NISN" name="nisn" value="{{ old('nisn', $formulir->nisn) }}">
            <span class="error-text" data-error="nisn"></span>
        </div>
        <div class="field">
            <label>NIK (sesuai KK)</label>
            <input placeholder="16 digit NIK" name="nik" value="{{ old('nik', $formulir->nik) }}">
            <span class="error-text" data-error="nik"></span>
        </div>
    </div>
    <div class="row2">
        <div class="field">
            <label>Nomor Kartu Keluarga</label>
            <input placeholder="16 digit No. KK" name="no_kk" value="{{ old('no_kk', $formulir->no_kk) }}">
            <span class="error-text" data-error="no_kk"></span>
        </div>
        <div class="field">
            <label>Nomor Akta Kelahiran</label>
            <input placeholder="Sesuai akta" name="no_akta" value="{{ old('no_akta', $formulir->no_akta) }}">
            <span class="error-text" data-error="no_akta"></span>
        </div>
    </div>
    <div class="row2">
        <div class="field">
            <label>Nama lengkap</label>
            <input placeholder="Sesuai akta kelahiran" name="nama_lengkap" value="{{ old('nama_lengkap', $formulir->nama_lengkap) }}">
            <span class="error-text" data-error="nama_lengkap"></span>
        </div>
        <div class="field">
            <label>Asal sekolah</label>
            <input placeholder="Nama SMP/MTs asal" name="asal_sekolah" value="{{ old('asal_sekolah', $formulir->asal_sekolah) }}">
            <span class="error-text" data-error="asal_sekolah"></span>
        </div>
    </div>
    <div class="row2">
        <div class="field">
            <label>Tempat lahir</label>
            <input placeholder="Kota kelahiran" name="tempat_lahir" value="{{ old('tempat_lahir', $formulir->tempat_lahir) }}">
            <span class="error-text" data-error="tempat_lahir"></span>
        </div>
        <div class="field">
            <label>Tanggal lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $formulir->tanggal_lahir?->format('Y-m-d')) }}">
            <span class="error-text" data-error="tanggal_lahir"></span>
        </div>
    </div>
    <div class="field">
        <label>Jenis kelamin</label>
        <select name="jenis_kelamin">
            <option value="Laki-laki" @selected(old('jenis_kelamin', $formulir->jenis_kelamin) === 'Laki-laki')>Laki-laki</option>
            <option value="Perempuan" @selected(old('jenis_kelamin', $formulir->jenis_kelamin) === 'Perempuan')>Perempuan</option>
        </select>
        <span class="error-text" data-error="jenis_kelamin"></span>
    </div>
    <div class="field">
        <label>Alamat lengkap</label>
        <textarea rows="2" name="alamat" placeholder="Sesuai KK">{{ old('alamat', $formulir->alamat) }}</textarea>
        <span class="error-text" data-error="alamat"></span>
    </div>
</div>