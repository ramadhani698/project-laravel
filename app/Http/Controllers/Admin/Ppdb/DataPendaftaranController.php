<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Ppdb\UpdateFormulirPendaftaranRequest;
use App\Http\Requests\Admin\Ppdb\VerifikasiBerkasRequest;
use App\Models\Jurusan;
use App\Models\Ppdb\PpdbBerkas;
use App\Models\Ppdb\PpdbFormulirPendaftaran;
use Illuminate\Support\Facades\Storage;

class DataPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $formulirList = PpdbFormulirPendaftaran::with(['pendaftar.berkas', 'jurusan'])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = $request->q;
                $query->where(function ($sub) use ($keyword) {
                    $sub->where('nama_lengkap', 'like', "%{$keyword}%")
                        ->orWhere('no_pendaftaran', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.ppdb.data-pendaftaran.index', compact('formulirList'));
    }

    public function edit(PpdbFormulirPendaftaran $formulir)
    {
        $formulir->load('pendaftar', 'jurusan');
        $jurusanList = Jurusan::orderBy('order')->get();
        $berkas = PpdbBerkas::where('ppdb_pendaftar_id', $formulir->ppdb_pendaftar_id)
            ->get()
            ->keyBy('jenis_dokumen');

        return view('admin.ppdb.data-pendaftaran.edit', compact('formulir', 'jurusanList', 'berkas'));
    }

    public function update(UpdateFormulirPendaftaranRequest $request, PpdbFormulirPendaftaran $formulir)
    {
        $formulir->update($request->validated());

        return redirect()
            ->route('admin.ppdb.data-pendaftaran.index', $formulir)
            ->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function verifikasiBerkas(VerifikasiBerkasRequest $request, PpdbBerkas $berkas)
    {
        $berkas->update($request->validated());

        // Cek otomatis: kalau semua dokumen wajib sudah valid, ubah status formulir
        $statusFormulirTerbaru = $this->cekDanUpdateStatusFormulir($berkas->ppdb_pendaftar_id);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'kode' => $berkas->jenis_dokumen,
                'status_verifikasi' => $berkas->status_verifikasi,
                'catatan_admin' => $berkas->catatan_admin,
                'status_formulir' => $statusFormulirTerbaru,
            ]);
        }

        return back()->with('success', 'Status verifikasi dokumen berhasil diperbarui.');
    }

    protected function cekDanUpdateStatusFormulir(int $pendaftarId): string
    {
        $wajibDasar = [
            'ktp_ortu', 'akta_kelahiran', 'kartu_keluarga',
            'rapor_semester_akhir', 'surat_keterangan_sehat',
        ];

        $berkas = PpdbBerkas::where('ppdb_pendaftar_id', $pendaftarId)->get()->keyBy('jenis_dokumen');

        $semuaDasarValid = collect($wajibDasar)->every(
            fn($jenis) => isset($berkas[$jenis]) && $berkas[$jenis]->status_verifikasi === 'valid'
        );

        $ijazahAtauSklValid = (isset($berkas['ijazah']) && $berkas['ijazah']->status_verifikasi === 'valid')
            || (isset($berkas['skl']) && $berkas['skl']->status_verifikasi === 'valid');

        $formulir = PpdbFormulirPendaftaran::where('ppdb_pendaftar_id', $pendaftarId)->first();

        if ($semuaDasarValid && $ijazahAtauSklValid) {
            $formulir?->update(['status' => 'terverifikasi']);
        }

        return $formulir?->status ?? 'menunggu_verifikasi';
    }

    public function destroy(PpdbFormulirPendaftaran $formulir)
    {
        $berkasList = PpdbBerkas::where('ppdb_pendaftar_id', $formulir->ppdb_pendaftar_id)->get();

        foreach ($berkasList as $berkas) {
            if ($berkas->file_path && Storage::disk('public')->exists($berkas->file_path)) {
                Storage::disk('public')->delete($berkas->file_path);
            }
            $berkas->delete();
        }

        $formulir->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}