<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(6);
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // compress gambar lalu simpan ke disk 'public'
            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('gallery/'.$imageName, (string) $encoded);
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // 3. siapin tempat upload gambar
        $imageName = $gallery->image;

        // 4. upload gambar
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($gallery->image && Storage::disk('public')->exists('gallery/'.$gallery->image)) {
                Storage::disk('public')->delete('gallery/'.$gallery->image);
            }

            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('gallery/'.$imageName, (string) $encoded);
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

        // 2. hapus gambar
        if ($gallery->image && Storage::disk('public')->exists('gallery/'.$gallery->image)) {
            Storage::disk('public')->delete('gallery/'.$gallery->image);
        }

        // 3. hapus dari db
        $gallery->delete();

        // 4. redirect
        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
