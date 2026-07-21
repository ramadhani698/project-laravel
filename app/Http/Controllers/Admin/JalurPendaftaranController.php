<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;

class JalurPendaftaranController extends Controller
{
    public function index()
    {
        $jalurs = JalurPendaftaran::orderBy('urutan')->get();

        return view('admin.jalur-pendaftaran.index', compact('jalurs'));
    }

    public function create()
    {
        return view('admin.jalur-pendaftaran.form', ['jalur' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'icon'       => 'required|in:reguler,prestasi,tahfidz,yatim',
            'warna'      => 'required|in:hijau,amber',
            'urutan'     => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        JalurPendaftaran::create($validated);

        return redirect()->route('admin.jalur-pendaftaran.index')
            ->with('success', 'Jalur pendaftaran berhasil ditambahkan.');
    }

    public function edit(JalurPendaftaran $jalur_pendaftaran)
    {
        return view('admin.jalur-pendaftaran.form', ['jalur' => $jalur_pendaftaran]);
    }

    public function update(Request $request, JalurPendaftaran $jalur_pendaftaran)
    {
        $validated = $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi'  => 'required|string',
            'icon'       => 'required|in:reguler,prestasi,tahfidz,yatim',
            'warna'      => 'required|in:hijau,amber',
            'urutan'     => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $jalur_pendaftaran->update($validated);

        return redirect()->route('admin.jalur-pendaftaran.index')
            ->with('success', 'Jalur pendaftaran berhasil diperbarui.');
    }

    public function destroy(JalurPendaftaran $jalur_pendaftaran)
    {
        $jalur_pendaftaran->delete();

        return redirect()->route('admin.jalur-pendaftaran.index')
            ->with('success', 'Jalur pendaftaran berhasil dihapus.');
    }
}