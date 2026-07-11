<div class="step-panel" data-step="5">
    <h2>Review &amp; kirim</h2>
    <p class="hint">Periksa kembali data sebelum dikirim ke panitia.</p>
    <div class="review-list" id="reviewList">
        <div class="review-item"><span class="k">Nama lengkap</span><span class="v" data-review="nama_lengkap">{{ $formulir->nama_lengkap ?? '-' }}</span></div>
        <div class="review-item"><span class="k">Asal sekolah</span><span class="v" data-review="asal_sekolah">{{ $formulir->asal_sekolah ?? '-' }}</span></div>
        <div class="review-item"><span class="k">Jurusan pilihan</span><span class="v" data-review="jurusan">{{ $formulir->jurusan?->name ?? '-' }}</span></div>
        <div class="review-item"><span class="k">Berkas terunggah</span><span class="v" id="reviewBerkasCount">{{ $berkas->count() }} / 7</span></div>
    </div>
    <div id="submitError" class="error-text"></div>
    <button type="button" class="btn btn-primary" id="btnSubmitFinal">Kirim Pendaftaran</button>
</div>