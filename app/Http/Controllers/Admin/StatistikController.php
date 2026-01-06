<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistik;

class StatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistiks = Statistik::orderBy('order', 'asc')->get();
        return view('admin.statistik.index', compact('statistiks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi form
        $request->validate([
            'value' => 'required',
            'label' => 'required',
            'order' => 'nullable|integer',
        ]);

        // 2. proses simpan data
        Statistik::create([
            'value' => $request->value,
            'label' => $request->label,
            'order' => $request->order ?? 0,
        ]);

        // 3. redirect ke index
        return redirect()
            ->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statistik = Statistik::findOrFail($id);
        return view('admin.statistik.edit', compact('statistik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. cari id dulu
        $statistik = Statistik::findOrFail($id);

        // 2. validasi form
        $request->validate([
            'value' => 'required',
            'label' => 'required',
            'order' => 'nullable|integer',
        ]);

        // 3. proses update
        $statistik->update([
            'value' => $request->value,
            'label' => $request->label,
            'order' => $request->order ?? 0
        ]);

        // 4.redirect ke index
        return redirect()
            ->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil di update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. cari id nya dulu
        $statistik = Statistik::findOrFail($id);

        // 2. hapus data
        $statistik->delete();

        // balik ke index
        return redirect()
            ->route('admin.statistik.index')
            ->with('success', 'Statistik berhasil dihapus');
    }
}
