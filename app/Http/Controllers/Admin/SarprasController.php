<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sarpras;

class SarprasController extends Controller
{
    public function index()
    {
        $sarpras = Sarpras::orderBy('order')->get();
        return view('admin.sarpras.index', compact('sarpras'));
    }

    public function create()
    {
        return view('admin.sarpras.create');
    }

    public function store(Request $request)
    {
        // 1. validasi
        $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // 2. simpan data
        Sarpras::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        // 3. redirect
        return redirect()
            ->route('admin.sarpras.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        // 1. cek id
        $sarpras = Sarpras::findOrFail($id);

        // 2. return view
        return view('admin.sarpras.edit', compact('sarpras'));
    }

    public function update(Request $request, $id)
    {
        // 1. cek id
        $sarpras = Sarpras::findOrFail($id);

        // 2. validasi
        $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // 3. update data
        $sarpras->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        // 4. redirect
        return redirect()
            ->route('admin.sarpras.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        // 1. cek id
        $sarpras = Sarpras::findOrFail($id);

        // 3. hapus data
        $sarpras->delete();

        // 4. redirect
        return redirect()
            ->route('admin.sarpras.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
