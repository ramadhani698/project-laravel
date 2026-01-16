<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Intervention\Image\Laravel\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(9);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        // 1. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // 2. siapin tempat upload gambar
        $imageName = null;

        // 3. upload gambar
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/gallery');

            // kalo folder nya blm ada
            if(!file_exists($path)) {
                mkdir($path, true, 0755);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 4. simpan ke db
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // 5. redirect
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($id)
    {
        // 1. cari id
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        // 1. cari id
        $gallery = Gallery::findOrFail($id);

        // 2. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jped,png,webp|max:10240',
        ]);

        // 3. siapin tempat upload gambar
        $imageName = $gallery->image;

        // 4. upload gambar
        if($request->hasFile('image')) {

            // hapus gambar lama
            $oldPath = public_path('uploads/gallery/'.$gallery->image);
            if(file_exists($oldPath)) {
                unlink($oldPath);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/gallery');

            // kalo folder nya blm ada
            if(!file_exists($path)) {
                mkdir($path, true, 0755);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. update ke db
        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // 6. redirect
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy($id)
    {
        // 1. cari id
        $gallery = Gallery::findOrFail($id);

        // 2. hapus gambar dari folder
        $imagePath = public_path('uploads/gallery/'.$gallery->image);
        if(file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. hapus dari db
        $gallery->delete();

        // 4. redirect
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
