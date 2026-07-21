<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerandaSetting;
use App\Models\Jurusan;
use App\Models\Persyaratan;
use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function index()
    {
        $dokumens = Persyaratan::orderBy('urutan')->get();

        return view('admin.persyaratan.index', compact('dokumens'));
    }
    public function tampilanPublik()
{
    $dokumens = Persyaratan::aktif()->get();
    $jalurs = JalurPendaftaran::aktif()->get();
    $jurusans = Jurusan:: orderBy ('order')->get();
     $settings = BerandaSetting::current();

    return view('ppdb.persyaratan', compact('dokumens', 'jalurs', 'jurusans', 'settings'));
}

    public function create()
    {
        return view('admin.persyaratan.form', ['dokumen' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'keterangan'   => 'nullable|string',
            'urutan'       => 'nullable|integer',
        ]);

        $validated['wajib'] = $request->has('wajib');
        $validated['is_active'] = $request->has('is_active');

        Persyaratan::create($validated);

        return redirect()->route('admin.persyaratan.index')
            ->with('success', 'Dokumen persyaratan berhasil ditambahkan.');
    }

    public function edit(Persyaratan $persyaratan)
    {
        return view('admin.persyaratan.form', ['dokumen' => $persyaratan]);
    }

    public function update(Request $request, Persyaratan $persyaratan)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'keterangan'   => 'nullable|string',
            'urutan'       => 'nullable|integer',
        ]);

        $validated['wajib'] = $request->has('wajib');
        $validated['is_active'] = $request->has('is_active');

        $persyaratan->update($validated);

        return redirect()->route('admin.persyaratan.index')
            ->with('success', 'Dokumen persyaratan berhasil diperbarui.');
    }

    public function destroy(Persyaratan $persyaratan)
    {
        $persyaratan->delete();

        return redirect()->route('admin.persyaratan.index')
            ->with('success', 'Dokumen persyaratan berhasil dihapus.');
    }
}