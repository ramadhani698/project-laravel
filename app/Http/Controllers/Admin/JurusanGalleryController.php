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
        // 1. cari id jurusan
        $jurusan = Jurusan::findOrFail($jurusanId);

        // 2. validasi form
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // 3. loop semua gambar
        $order = $jurusan->galleries()->max('order') + 1;
        foreach ($request->file('images') as $image) {

            // nama file unik
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // compress gambar lalu simpan ke disk 'public'
            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('jurusan_gallery/'.$imageName, (string) $encoded);

            // simpan ke database
            $jurusan->galleries()->create([
                'image' => $imageName,
                'order' => $order++,
            ]);
        }

        // 4. redirect ke halaman edit
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
