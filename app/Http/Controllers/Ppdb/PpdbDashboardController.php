<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ppdb\PendaftaranStepRequest;
use App\Http\Requests\Ppdb\UploadBerkasRequest;
use App\Models\Jurusan;
use App\Models\Ppdb\PpdbBerkas;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ppdb\PpdbHasilSeleksi;
use App\Models\Ppdb\PpdbFormulirPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PpdbDashboardController extends Controller
{
    public function index()
    {
        $pendaftar = Auth::guard('ppdb')->user();

        $formulir = PpdbFormulirPendaftaran::firstOrCreate(
            ['ppdb_pendaftar_id' => $pendaftar->id],
            ['current_step' => 1, 'status' => 'draft']
        );

        $berkas = PpdbBerkas::where('ppdb_pendaftar_id', $pendaftar->id)
            ->get()
            ->keyBy('jenis_dokumen');

        if ($formulir->status !== 'draft') {
            $hasilSeleksi = PpdbHasilSeleksi::where('formulir_pendaftaran_id', $formulir->id)
                ->whereNotNull('tanggal_pengumuman')
                ->where('tanggal_pengumuman', '<=', now()->toDateString())
                ->first();

            return view('ppdb.dashboard.status', compact('pendaftar', 'formulir', 'berkas', 'hasilSeleksi'));
        }

        $jurusanList = Jurusan::orderBy('order')->get();

        return view('ppdb.dashboard.index', compact('pendaftar', 'formulir', 'jurusanList', 'berkas'));
    }

    public function saveStep(PendaftaranStepRequest $request, int $step)
    {
        $pendaftar = Auth::guard('ppdb')->user();
        $formulir = PpdbFormulirPendaftaran::where('ppdb_pendaftar_id', $pendaftar->id)->firstOrFail();

        if ($formulir->status !== 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'Formulir sudah disubmit, tidak bisa diubah lagi.',
            ], 403);
        }

        $formulir->fill($request->validated());
        $formulir->current_step = max($formulir->current_step, $step + 1);
        $formulir->save();

        return response()->json([
            'success' => true,
            'message' => 'Data tersimpan.',
            'next_step' => $step + 1,
        ]);
    }

    public function uploadBerkas(UploadBerkasRequest $request)
    {
        $pendaftar = Auth::guard('ppdb')->user();

        $existing = PpdbBerkas::where('ppdb_pendaftar_id', $pendaftar->id)
            ->where('jenis_dokumen', $request->jenis_dokumen)
            ->first();

        // dokumen yang sudah valid dikunci, tidak bisa diganti sepihak oleh siswa
        if ($existing && $existing->status_verifikasi === 'valid') {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen ini sudah diverifikasi valid dan tidak bisa diganti.',
            ], 403);
        }

        if ($existing && $existing->file_path && Storage::disk('public')->exists($existing->file_path)) {
            Storage::disk('public')->delete($existing->file_path);
        }

        $file = $request->file('file');
        $filename = time() . '_' . uniqid() . '.' . $file->extension();
        $path = $file->storeAs('ppdb/berkas/' . $pendaftar->id, $filename, 'public');

        $berkas = PpdbBerkas::updateOrCreate(
            ['ppdb_pendaftar_id' => $pendaftar->id, 'jenis_dokumen' => $request->jenis_dokumen],
            [
                'nama_asli' => $file->getClientOriginalName(),
                'file_path' => $path,
                'ukuran' => $file->getSize(),
                'status_verifikasi' => 'menunggu',
                'catatan_admin' => null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Berkas berhasil diunggah.',
            'file_url' => Storage::url($path),
            'nama_asli' => $berkas->nama_asli,
        ]);
    }

    public function deleteBerkas(PpdbBerkas $berkas)
    {
        abort_unless($berkas->ppdb_pendaftar_id === Auth::guard('ppdb')->id(), 403);

        // Opsi A: dokumen yang sudah valid dikunci, tidak bisa dihapus sepihak oleh siswa
        if ($berkas->status_verifikasi === 'valid') {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen ini sudah diverifikasi valid dan tidak bisa dihapus.',
            ], 403);
        }

        if ($berkas->file_path && Storage::disk('public')->exists($berkas->file_path)) {
            Storage::disk('public')->delete($berkas->file_path);
        }
        $berkas->delete();

        return response()->json(['success' => true]);
    }

    public function submit()
    {
        $pendaftar = Auth::guard('ppdb')->user();
        $formulir = PpdbFormulirPendaftaran::where('ppdb_pendaftar_id', $pendaftar->id)->firstOrFail();

        if ($formulir->status !== 'draft') {
            return response()->json([
                'success' => false,
                'message' => 'Formulir sudah pernah disubmit.',
            ], 403);
        }

        $wajibDasar = [
            'ktp_ortu', 'akta_kelahiran', 'kartu_keluarga',
            'rapor_semester_akhir', 'surat_keterangan_sehat',
        ];

        $jenisTerkumpul = PpdbBerkas::where('ppdb_pendaftar_id', $pendaftar->id)
            ->pluck('jenis_dokumen');

        $kurangDasar = collect($wajibDasar)->diff($jenisTerkumpul);
        $adaIjazahAtauSkl = $jenisTerkumpul->contains('ijazah') || $jenisTerkumpul->contains('skl');

        if ($kurangDasar->isNotEmpty() || !$adaIjazahAtauSkl) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen belum lengkap. Minimal salah satu dari Ijazah atau SKL harus diunggah.',
                'kurang' => $kurangDasar->values(),
            ], 422);
        }

        $formulir->no_pendaftaran = $formulir->generateNoPendaftaran();
        $formulir->status = 'menunggu_verifikasi';
        $formulir->save();

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil dikirim.',
            'no_pendaftaran' => $formulir->no_pendaftaran,
        ]);
    }

    public function cetakKartuPeserta()
    {
        $pendaftar = Auth::guard('ppdb')->user();

        $formulir = PpdbFormulirPendaftaran::where('ppdb_pendaftar_id', $pendaftar->id)->firstOrFail();

        $hasilSeleksi = $formulir->hasilSeleksi()
            ->whereNotNull('tanggal_pengumuman')
            ->where('tanggal_pengumuman', '<=', now()->toDateString())
            ->first();

        $eligible = $formulir->status === 'terverifikasi'
            && $hasilSeleksi
            && $hasilSeleksi->status_kelulusan === 'lulus';

        abort_unless($eligible, 403, 'Kartu peserta hanya bisa dicetak setelah berkas terverifikasi dan dinyatakan lulus seleksi.');

        $pdf = Pdf::loadView('ppdb.pdf.kartu-peserta', [
            'pendaftar' => $pendaftar,
            'formulir' => $formulir,
            'hasilSeleksi' => $hasilSeleksi,
        ])->setPaper('a5', 'landscape');

        return $pdf->stream('kartu-peserta-' . $formulir->no_pendaftaran . '.pdf');
    }

    public function cetakLembarPernyataan()
    {
        $pendaftar = Auth::guard('ppdb')->user();

        $formulir = PpdbFormulirPendaftaran::where('ppdb_pendaftar_id', $pendaftar->id)->firstOrFail();

        $hasilSeleksi = $formulir->hasilSeleksi()
            ->whereNotNull('tanggal_pengumuman')
            ->where('tanggal_pengumuman', '<=', now()->toDateString())
            ->first();

        $eligible = $formulir->status === 'terverifikasi'
            && $hasilSeleksi
            && $hasilSeleksi->status_kelulusan === 'lulus';

        abort_unless($eligible, 403, 'Lembar pernyataan hanya bisa dicetak setelah berkas terverifikasi dan dinyatakan lulus seleksi.');

        $pdf = Pdf::loadView('ppdb.pdf.lembar-pernyataan', [
            'pendaftar' => $pendaftar,
            'formulir' => $formulir,
            'hasilSeleksi' => $hasilSeleksi,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('lembar-pernyataan-' . $formulir->no_pendaftaran . '.pdf');
    }
}