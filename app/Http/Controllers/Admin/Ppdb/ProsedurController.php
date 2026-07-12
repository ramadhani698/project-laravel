<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\ppdb\PpdbFiturProsedur;
use Illuminate\Http\Request;

class ProsedurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prosedurs = PpdbFiturProsedur::orderBy('order')->get();
    return view('admin.ppdb.prosedur.index', compact('prosedurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ppdb.prosedur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi data dari form
        $request->validate([
            'label' => 'required',
            'title' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
            'aktif' => 'nullable|boolean',
        ]);

        // 2. proses simpan ke database
        PpdbFiturProsedur::create([
            'label' => $validate->label,
            'title' => $validate->title,
            'description' => $validate->description,
            'order' => $validate->order ?? 0,
            'aktif' => $request->aktif ?? false,
        ]);

        // 3. redirect ke halaman index
        return redirect()
            ->route('admin.ppdb.prosedur.index')
            ->with('success', 'Prosedur berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1. ambil data prosedur sesuai id nya
        $prosedur = PpdbFiturProsedur::findOrFail($id);
        return view('admin.ppdb.prosedur.show', compact('prosedur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. ambil data prosedur sesuai id nya
        $prosedur = PpdbFiturProsedur::findOrFail($id);
        return view('admin.ppdb.prosedur.edit', compact('prosedur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. cari data sesuai id nya
        $prosedur = PpdbFiturProsedur::findOrFail($id);

        // 2. validasi data
        $request->validate([
            'label' => 'required',
            'title' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
            'aktif' => 'nullable|boolean',
        ]);

        // 3. update data
        $prosedur->update([
            'label' => $validate->label,
            'title' => $validate->title,
            'description' => $validate->description,
            'order' => $validate->order ?? 0,
            'aktif' => $request->aktif ?? false,
        ]);

        // 4. redirect ke halaman index
        return redirect()
            ->route('admin.ppdb.prosedur.index')
            ->with('success', 'Prosedur berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. cari data sesuai id nya
        $prosedur = PpdbFiturProsedur::findOrFail($id);

        // 2. hapus data
        $prosedur->delete();

        // 3. redirect ke halaman index
        return redirect()
            ->route('admin.ppdb.prosedur.index')
            ->with('success', 'Prosedur berhasil dihapus');
    }
}
