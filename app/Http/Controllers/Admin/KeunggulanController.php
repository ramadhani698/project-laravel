<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keunggulan;

class KeunggulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keunggulans = Keunggulan::orderBy('order')->get();
        return view('admin.keunggulan.index', compact('keunggulans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keunggulan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi data dari form
        $request->validate([
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
        ]);

        // 2. proses simpan ke database
        Keunggulan::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order ?? 0,
        ]);

        // 3. redirect ke halaman index
        return redirect()
            ->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 1. ambil data keunggulan sesuai id nya
        $keunggulan = Keunggulan::findOrFail($id);
        return view('admin.keunggulan.edit', compact('keunggulan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. cari data sesuai id nya
        $keunggulan = Keunggulan::findOrFail($id);

        // 2. validasi data
        $request->validate([
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
            'order' => 'nullable|integer',
        ]);

        // 3. proses update ke database
        $keunggulan->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' =>$request->description,
            'order' =>$request->order ?? 0,
        ]);

        // 3. redirect ke halaman index
        return redirect()
            ->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. cari data sesuai id nya
        $keunggulan = Keunggulan::findOrFail($id);

        // 2. hapus data
        $keunggulan->delete();

        // 3. redirect ke halaman index
        return redirect()
            ->route('admin.keunggulan.index')
            ->with('success', 'Keunggulan berhasil dihapus');
    }
}
