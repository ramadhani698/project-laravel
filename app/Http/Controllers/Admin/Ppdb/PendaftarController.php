<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbPendaftar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = PpdbPendaftar::latest()->paginate(10);
        return view('admin.ppdb.index', compact('pendaftars'));
    }
    
    public function destroy(PpdbPendaftar $pendaftar): RedirectResponse
    {
        $pendaftarId = $pendaftar->id;

        DB::transaction(function () use ($pendaftar) {
            $pendaftar->berkas()->delete();
            $pendaftar->delete();
        });

        // Storage bukan bagian dari DB transaction, jadi taruh di luar
        $folderPath = "ppdb/berkas/{$pendaftarId}";
        if (Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->deleteDirectory($folderPath);
        }

        return redirect()
            ->route('admin.ppdb.pendaftar.index')
            ->with('success', 'Akun pendaftar berhasil dihapus.');
    }
}