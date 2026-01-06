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
        // 1. cari id jurusan
        $jurusan = Jurusan::findOrFail($jurusanId);

        // 2. validasi form
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        // 3. ubah string jadi array
        $misiArray = array_filter(
            array_map('trim', explode("\n", $request->misi))
        );

        // 4. update / create visi dan misi
        $jurusan->visiMisi()->updateOrCreate(
            ['jurusan_id' => $jurusan->id],
            [
                'visi' => $request->visi,
                'misi' => $misiArray,
            ]
        );

        // 5. redirect ke halaman edit
        return back()->with('success', 'Visi dan Misi jurusan berhasil diupdate');
    }
}
