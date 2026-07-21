<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbHasilSeleksi;
use App\Exports\SiswaDiterimaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SiswaDiterimaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswaDiterima = PpdbHasilSeleksi::query()
            ->where('status_kelulusan', 'lulus')
            ->with(['formulirPendaftaran.jurusan', 'formulirPendaftaran.pendaftar'])
            ->when($search, function ($query, $search) {
                $query->whereHas('formulirPendaftaran', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('no_pendaftaran', 'like', "%{$search}%");
                });
            })
            ->latest('tanggal_pengumuman')
            ->paginate(20)
            ->withQueryString();

        return view('admin.ppdb.siswa-diterima.index', compact('siswaDiterima', 'search'));
    }

    public function show(PpdbHasilSeleksi $hasil)
    {
        $hasil->load([
            'formulirPendaftaran.jurusan',
            'formulirPendaftaran.pendaftar.berkas',
        ]);

        return view('admin.ppdb.siswa-diterima.show', compact('hasil'));
    }

    public function export()
    {
        return Excel::download(
            new SiswaDiterimaExport,
            'Data-Siswa-Diterima-PPDB-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}