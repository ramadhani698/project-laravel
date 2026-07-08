<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\JurusanVisiMisi;

class JurusanVisiMisiController extends Controller
{
    /**
    * Update Visi dan Misi untuk satu jurusan
    */

    public function update(Request $request, $jurusanId)
    {
        $jurusan = Jurusan::findOrFail($jurusanId);

        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $misiArray = array_filter(
            array_map('trim', explode("\n", $request->misi))
        );

        $jurusan->visiMisi()->updateOrCreate(
            ['jurusan_id' => $jurusan->id],
            [
                'visi' => $request->visi,
                'misi' => $misiArray,
            ]
        );

        // NEW: kalau dari wizard, lanjut ke step 4 (Galeri)
        if ($request->has('wizard')) {
            return redirect()
                ->route('admin.jurusan.wizard.gallery', $jurusan->id)
                ->with('success', 'Visi & misi berhasil disimpan.');
        }

        return back()->with('success', 'Visi dan Misi jurusan berhasil diupdate');
    }
}
