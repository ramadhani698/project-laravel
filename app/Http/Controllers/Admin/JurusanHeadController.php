<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\JurusanHead;
use Intervention\Image\Laravel\Facades\Image;

class JurusanHeadController extends Controller
{
    /**
    * Update Kepala Kompetensi untuk satu jurusan
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $jurusanId
    */

    public function update(Request $request, $jurusanId)
    {
        // 1. cari id jurusan
        $jurusan = Jurusan::findOrFail($jurusanId);

        // 2. validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // 3. photo lama
        $photoName = $jurusan->head->photo ?? null;

        // 4. upload foto baru
        if ($request->hasFile('photo')) {

            // hapus foto lama (kalo ada)
            if ($photoName) {
                $oldPath = public_path('uploads/jurusan_head/' . $photoName);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // upload foto baru
            $photo = $request->File('photo');
            $photoName = time(). '.' . $photo->extension();
            $path = public_path('uploads/jurusan_head');

            // buat folder kalo belom ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            Image::read($photo)
                ->save($path.'/'.$photoName, 75);
        }

        // 5. update / create kepala jurusan
        $jurusan->head()->updateOrCreate(
            ['jurusan_id' => $jurusan->id],
            [
                'name' => $request->name,
                'title' => $request->title,
                'photo' => $photoName,
            ]
        );

        // 6. redirect ke halaman edit
        return back()->with('success', 'Kepala kompetensi jurusan berhasil diupdate');
    }
}
