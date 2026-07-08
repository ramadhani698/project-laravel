<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\JurusanGallery;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class JurusanGalleryController extends Controller
{
    /**
    * Update foto galeri per jurusan
    */

    public function store(Request $request, $jurusanId)
    {
        $jurusan = Jurusan::findOrFail($jurusanId);

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $order = $jurusan->galleries()->max('order') + 1;
        foreach ($request->file('images') as $image) {
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('jurusan_gallery/'.$imageName, (string) $encoded);

            $jurusan->galleries()->create([
                'image' => $imageName,
                'order' => $order++,
            ]);
        }

        // NEW: kalau dari wizard, tetap di halaman wizard galeri (biar bisa upload lagi / klik Selesai)
        if ($request->has('wizard')) {
            return redirect()
                ->route('admin.jurusan.wizard.gallery', $jurusan->id)
                ->with('success', 'Foto galeri berhasil ditambahkan.');
        }

        return back()->with('success', 'Gallery berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // 1. cari id gallery
        $gallery = JurusanGallery::findOrFail($id);

        // 2. hapus file
        if ($gallery->image && Storage::disk('public')->exists('jurusan_gallery/'.$gallery->image)) {
            Storage::disk('public')->delete('jurusan_gallery/'.$gallery->image);
        }

        // 3. hapus data dari db
        $gallery->delete();

        // redirect ke halaman sebelumnya
        return back()->with('success', 'Galeri berhasil dihapus');
    }
}
