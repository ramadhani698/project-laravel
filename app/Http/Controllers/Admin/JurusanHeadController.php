<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\JurusanHead;
use Illuminate\Support\Facades\Storage;
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
            if ($photoName && Storage::disk('public')->exists('jurusan_head/'.$photoName)) {
                Storage::disk('public')->delete('jurusan_head/'.$photoName);
            }

            // upload foto baru
            $photo = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$photo->extension();

            $encoded = Image::read($photo)->encodeByExtension($photo->extension(), quality: 75);
            Storage::disk('public')->put('jurusan_head/'.$photoName, (string) $encoded);
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
