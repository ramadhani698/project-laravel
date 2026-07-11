<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbPendaftar;
use Illuminate\Http\RedirectResponse;
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
        foreach ($pendaftar->berkas as $berkas) {
            if ($berkas->file_path && Storage::disk('public')->exists($berkas->file_path)) {
                Storage::disk('public')->delete($berkas->file_path);
            }
        }

        $pendaftar->delete();

        return redirect()
            ->route('admin.ppdb.pendaftar.index')
            ->with('success', 'Akun pendaftar berhasil dihapus.');
    }
}
