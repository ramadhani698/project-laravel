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
        $jurusan = Jurusan::findOrFail($jurusanId);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $photoName = $jurusan->head->photo ?? null;

        if ($request->hasFile('photo')) {
            if ($photoName && Storage::disk('public')->exists('jurusan_head/'.$photoName)) {
                Storage::disk('public')->delete('jurusan_head/'.$photoName);
            }

            $photo = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$photo->extension();

            $encoded = Image::read($photo)->encodeByExtension($photo->extension(), quality: 75);
            Storage::disk('public')->put('jurusan_head/'.$photoName, (string) $encoded);
        }

        $jurusan->head()->updateOrCreate(
            ['jurusan_id' => $jurusan->id],
            [
                'name' => $request->name,
                'title' => $request->title,
                'photo' => $photoName,
            ]
        );

        // NEW: kalau datang dari wizard, lanjut ke step 3. Kalau dari edit biasa, tetap back().
        if ($request->has('wizard')) {
            return redirect()
                ->route('admin.jurusan.wizard.visi-misi', $jurusan->id)
                ->with('success', 'Kepala kompetensi berhasil disimpan.');
        }

        return back()->with('success', 'Kepala kompetensi jurusan berhasil diupdate');
    }
}
