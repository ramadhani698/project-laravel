<div class="step-panel" data-step="2">
    <h2>Data keluarga</h2>
    <p class="hint">Data orang tua yang bertanggung jawab.</p>
    <div class="row2">
        <div class="field">
            <label>Nama ayah</label>
            <input name="nama_ayah" value="{{ old('nama_ayah', $formulir->nama_ayah) }}">
            <span class="error-text" data-error="nama_ayah"></span>
        </div>
        <div class="field">
            <label>NIK ayah</label>
            <input name="nik_ayah" placeholder="Opsional" value="{{ old('nik_ayah', $formulir->nik_ayah) }}">
            <span class="error-text" data-error="nik_ayah"></span>
        </div>
    </div>
    <div class="field">
        <label>Pekerjaan ayah</label>
        <input name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $formulir->pekerjaan_ayah) }}">
        <span class="error-text" data-error="pekerjaan_ayah"></span>
    </div>
    <div class="row2">
        <div class="field">
            <label>Nama ibu</label>
            <input name="nama_ibu" value="{{ old('nama_ibu', $formulir->nama_ibu) }}">
            <span class="error-text" data-error="nama_ibu"></span>
        </div>
        <div class="field">
            <label>NIK ibu</label>
            <input name="nik_ibu" placeholder="Opsional" value="{{ old('nik_ibu', $formulir->nik_ibu) }}">
            <span class="error-text" data-error="nik_ibu"></span>
        </div>
    </div>
    <div class="row2">
        <div class="field">
            <label>Pekerjaan ibu</label>
            <input name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $formulir->pekerjaan_ibu) }}">
            <span class="error-text" data-error="pekerjaan_ibu"></span>
        </div>
        <div class="field">
            <label>No. HP orang tua</label>
            <input placeholder="08xxxxxxxxxx" name="no_hp_ortu" value="{{ old('no_hp_ortu', $formulir->no_hp_ortu) }}">
            <span class="error-text" data-error="no_hp_ortu"></span>
        </div>
    </div>
</div>