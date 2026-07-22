<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbTesAttempts;
use App\Models\Ppdb\PpdbJawabanPendaftar;
use App\Models\Ppdb\PpdbSoalTes;
use App\Models\Ppdb\PpdbPeriodeTes;
use App\Models\Ppdb\PpdbHasilSeleksi;
use App\Http\Requests\Ppdb\SimpanJawabanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TesOnlineController extends Controller
{

    private const DURASI_TES_MENIT = 120; // 2 jam

    public function index()
    {
        $formulir = Auth::guard('ppdb')->user()->formulir;

        if (!$formulir) {
            return redirect()
                ->route('ppdb.dashboard')
                ->with('warning', 'Lengkapi dan submit formulir pendaftaran terlebih dahulu sebelum mengakses tes online.');
        }

        $periodeAktif = PpdbPeriodeTes::where('is_aktif', true)
            ->whereDate('tanggal_buka_tes', '<=', now())
            ->whereDate('tanggal_tutup_tes', '>=', now())
            ->first();

        $attempt = PpdbTesAttempts::where('formulir_pendaftaran_id', $formulir->id)->first();

        $bisaMulai = $formulir->status === 'terverifikasi'
            && $periodeAktif !== null
            && (!$attempt || $attempt->status === 'belum_mulai');

        return view('ppdb.tes.index', compact('formulir', 'periodeAktif', 'bisaMulai', 'attempt'));
    }
    
    public function mulai()
    {
        $formulir = Auth::guard('ppdb')->user()->formulir;
        
        abort_unless($formulir, 403, 'Formulir pendaftaran belum dibuat.');
        abort_unless($formulir->status === 'terverifikasi', 403, 'Formulir belum diverifikasi.');

        $periodeAktif = PpdbPeriodeTes::where('is_aktif', true)
            ->whereDate('tanggal_buka_tes', '<=', now())
            ->whereDate('tanggal_tutup_tes', '>=', now())
            ->first();

        abort_unless($periodeAktif !== null, 403, 'Tidak ada periode tes yang aktif saat ini.');

        $attempt = PpdbTesAttempts::firstOrCreate(
            ['formulir_pendaftaran_id' => $formulir->id],
            [
                'periode_tes_id' => $periodeAktif->id,
                'status' => 'belum_mulai', // <-- tambahkan ini
            ]
        );

        abort_if($attempt->status === 'selesai', 403, 'Tes sudah pernah diselesaikan.');

        if ($attempt->status === 'belum_mulai') {
            $attempt->update([
                'status' => 'sedang_mengerjakan',
                'waktu_mulai' => now(),
            ]);
        }

        return redirect()->route('ppdb.tes.kerjakan');
    }

    public function kerjakan()
    {
        $formulir = Auth::guard('ppdb')->user()->formulir;

        abort_unless($formulir, 403, 'Formulir pendaftaran belum dibuat.');

        $attempt = PpdbTesAttempts::where('formulir_pendaftaran_id', $formulir->id)->firstOrFail();

        abort_unless($attempt->status === 'sedang_mengerjakan', 403, 'Tes tidak sedang berlangsung.');

        $batasWaktu = $attempt->waktu_mulai->copy()->addMinutes(self::DURASI_TES_MENIT);
        
        // Kalau ternyata waktu sudah habis (misal user reload / balik lagi setelah 2 jam), langsung finalisasi
        if (now()->greaterThanOrEqualTo($batasWaktu)) {
            $this->finalisasiTes($attempt, $formulir);

            return redirect()->route('ppdb.dashboard')
                ->with('warning', 'Waktu pengerjaan tes sudah habis. Jawaban kamu telah dikunci dan dinilai otomatis.');
        }

        $sisaDetik = max(0, (int) now()->diffInSeconds($batasWaktu, false));
        $soal = PpdbSoalTes::select('id', 'jurusan_id', 'tipe_soal', 'pertanyaan', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d')
            ->where('tipe_soal', 'akademik')
            ->orWhere(function ($q) use ($formulir) {
                $q->where('tipe_soal', 'kejuruan')->where('jurusan_id', $formulir->jurusan_id);
            })
            ->get();

        $jawabanTersimpan = PpdbJawabanPendaftar::where('formulir_pendaftaran_id', $formulir->id)
            ->pluck('jawaban_dipilih', 'soal_tes_id');

        return view('ppdb.tes.kerjakan', compact('soal', 'attempt', 'jawabanTersimpan', 'sisaDetik'));
    }

    public function jawab(SimpanJawabanRequest $request)
    {
        $formulir = Auth::guard('ppdb')->user()->formulir;

        abort_unless($formulir, 403, 'Formulir pendaftaran belum dibuat.');

        $attempt = PpdbTesAttempts::where('formulir_pendaftaran_id', $formulir->id)->firstOrFail();

        abort_unless($attempt->status === 'sedang_mengerjakan', 403, 'Sesi tes tidak aktif.');

        $batasWaktu = $attempt->waktu_mulai->copy()->addMinutes(self::DURASI_TES_MENIT);
        
        if (now()->greaterThanOrEqualTo($batasWaktu)) {
            $this->finalisasiTes($attempt, $formulir);

            return response()->json([
                'success' => false,
                'expired' => true,
                'message' => 'Waktu tes sudah habis.',
            ], 403);
        }

        $soal = PpdbSoalTes::findOrFail($request->soal_tes_id);
        abort_if(
            $soal->tipe_soal === 'kejuruan' && $soal->jurusan_id !== $formulir->jurusan_id,
            403,
            'Soal tidak sesuai jurusan.'
        );

        PpdbJawabanPendaftar::updateOrCreate(
            [
                'formulir_pendaftaran_id' => $formulir->id,
                'soal_tes_id' => $request->soal_tes_id,
            ],
            ['jawaban_dipilih' => $request->jawaban_dipilih]
        );

        return response()->json(['success' => true]);
    }

    public function selesai()
    {
        $formulir = Auth::guard('ppdb')->user()->formulir;

        abort_unless($formulir, 403, 'Formulir pendaftaran belum dibuat.');

        $attempt = PpdbTesAttempts::where('formulir_pendaftaran_id', $formulir->id)->firstOrFail();

        abort_unless($attempt->status === 'sedang_mengerjakan', 403, 'Tes tidak sedang berlangsung.');

        $this->finalisasiTes($attempt, $formulir);

        return redirect()->route('ppdb.dashboard')
            ->with('success', 'Tes berhasil diselesaikan. Hasil akan diumumkan oleh admin.');
    }

    /**
     * Dipanggil baik saat user klik "Selesai Tes" manual,
     * maupun saat sistem mendeteksi waktu sudah habis (auto-submit).
     */
    private function finalisasiTes(PpdbTesAttempts $attempt, $formulir): void
    {
        DB::transaction(function () use ($attempt, $formulir) {
            $attempt->update([
                'status' => 'selesai',
                'waktu_selesai_mengerjakan' => now(),
            ]);

            $this->hitungNilai($formulir->id);
        });
    }

    private function hitungNilai(int $formulirId): void
    {
        $formulir = \App\Models\Ppdb\PpdbFormulirPendaftaran::findOrFail($formulirId);
        $totalAkademik = PpdbSoalTes::where('tipe_soal', 'akademik')->count();
        $totalKejuruan = PpdbSoalTes::where('tipe_soal', 'kejuruan')
            ->where('jurusan_id', $formulir->jurusan_id)
            ->count();
        $jawaban = PpdbJawabanPendaftar::where('formulir_pendaftaran_id', $formulirId)
            ->with('soalTes')
            ->get();
        $benarAkademik = 0;
        $benarKejuruan = 0;
        foreach ($jawaban as $j) {
            $soal = $j->soalTes;
            if (!$soal) continue;
            $isBenar = $j->jawaban_dipilih === $soal->kunci_jawaban;
            
            if ($soal->tipe_soal === 'akademik') {
                if ($isBenar) $benarAkademik++;
            } else {
                if ($isBenar) $benarKejuruan++;
            }
        }
        
        PpdbHasilSeleksi::updateOrCreate(
            ['formulir_pendaftaran_id' => $formulirId],
            [
                'nilai_akademik' => $totalAkademik > 0 ? round(($benarAkademik / $totalAkademik) * 100, 2) : null,
                'nilai_kejuruan' => $totalKejuruan > 0 ? round(($benarKejuruan / $totalKejuruan) * 100, 2) : null,
            ]
        );
    }
}