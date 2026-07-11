<div class="step-panel" data-step="4">
    <h2>Upload berkas</h2>
    <p class="hint">Format PDF/JPG/PNG, maksimal 10MB per file.</p>

    @php
        $dokumenList = [
            'ktp_ortu' => 'KTP orang tua',
            'akta_kelahiran' => 'Akta kelahiran',
            'kartu_keluarga' => 'Kartu Keluarga',
            'rapor_semester_akhir' => 'Rapor semester akhir',
            'surat_keterangan_sehat' => 'Surat keterangan sehat',
            'ijazah' => 'Ijazah',
            'skl' => 'Surat Keterangan Lulus (SKL)',
        ];
    @endphp

    @foreach ($dokumenList as $kode => $label)
        <div class="upload-row" data-jenis-row="{{ $kode }}" data-uploaded="{{ isset($berkas[$kode]) ? '1' : '0' }}">
            <div>
                <div class="doc-name">{{ $label }}</div>
                <div class="doc-sub" data-doc-sub="{{ $kode }}">
                    @if(isset($berkas[$kode]))
                        Sudah diunggah: {{ $berkas[$kode]->nama_asli }}
                    @elseif(in_array($kode, ['ijazah', 'skl']))
                        Opsional — minimal salah satu (Ijazah/SKL) wajib diisi
                    @else
                        Belum diunggah
                    @endif
                </div>
            </div>
            <input type="file" class="berkas-input" data-jenis="{{ $kode }}" accept=".pdf,.jpg,.jpeg,.png" hidden>
            <button type="button" class="upload-btn" onclick="this.previousElementSibling.click()">Unggah</button>
        </div>
    @endforeach
</div>