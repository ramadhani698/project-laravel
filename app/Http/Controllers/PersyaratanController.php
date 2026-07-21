<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function index()
    {
        $dokumens = Persyaratan::orderBy('urutan')->get();
        

        return view('admin.persyaratan.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.persyaratan.form', ['dokumen' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dokumen'        => 'required|string|max:255',
            'keterangan'          => 'nullable|string',
            'urutan'              => 'nullable|integer',
            'maksimal_ukuran_kb'  => 'nullable|integer',
            'format_diizinkan'    => 'nullable|array',
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
            'nama_dokumen'        => 'required|string|max:255',
            'keterangan'          => 'nullable|string',
            'urutan'              => 'nullable|integer',
            'maksimal_ukuran_kb'  => 'nullable|integer',
            'format_diizinkan'    => 'nullable|array',
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