<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbHasilSeleksi;
use App\Http\Requests\Ppdb\UpdateHasilSeleksiRequest;

class HasilSeleksiController extends Controller
{
    public function index()
    {
        $hasilSeleksi = PpdbHasilSeleksi::with('formulirPendaftaran')
            ->latest()
            ->paginate(15);

        return view('admin.ppdb.hasil-seleksi.index', compact('hasilSeleksi'));
    }

    public function show(PpdbHasilSeleksi $hasilSeleksi)
    {
        $hasilSeleksi->load('formulirPendaftaran');

        return view('admin.ppdb.hasil-seleksi.show', compact('hasilSeleksi'));
    }

    public function update(UpdateHasilSeleksiRequest $request, PpdbHasilSeleksi $hasilSeleksi)
    {
        $hasilSeleksi->update($request->validated());

        return redirect()
            ->route('admin.ppdb.hasil-seleksi.index', $hasilSeleksi)
            ->with('success', 'Status kelulusan berhasil diperbarui.');
    }
}
