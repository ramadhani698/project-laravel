<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\JurusanGallery;
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

        // 3. lokasi folder uploads
        $path = public_path('uploads/jurusan_gallery');

        if(!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        
        // 4. loop semua gambar
        $order = $jurusan->galleries()->max('order') + 1;
        foreach ($request->file('images') as $image) {

            // nama file unik
            $imageName = time().'.'.uniqid().'.'.$image->extension();

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);

            // simpan ke database
            $jurusan->galleries()->create([
                'image' => $imageName,
                'order' => $order++,
            ]);
        }

        // 5. redirect ke halaman edit
        return back()->with('success', 'Gallery berhasil ditambahkan');
    }

    public function destroy($id)
    {
        // 1. cari id gallery
        $gallery = JurusanGallery::findOrFail($id);

        // 2. hapus file fisik
        $imagePath = public_path('uploads/jurusan_gallery/'.$gallery->image);
        if ($gallery->image && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. hapus data dari db
        $gallery->delete();

        // redirect ke halaman sebelumnya
        return back()->with('success', 'Galeri berhasil dihapus');
    }
}
