<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('id', 'asc')->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        // 1. validasi form dulu
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'title' => 'nullable|string',
        ]);

        // 2. siapin tempat buat upload gambar
        $imageName = null;

        // 3. proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // compress gambar lalu simpan ke disk 'public'
            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('carousel/'.$imageName, (string) $encoded);
        }

        // 4. simpan data ke db
        Carousel::create([
            'image' => $imageName,
            'title' => $request->title,
        ]);

        // 5. redirect ke index
        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        // 1. cek id yg mau di edit
        $carousel = Carousel::findOrFail($id);

        // 2. validasi form dulu
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'title' => 'nullable|string',
        ]);

        // 3. siapin tempat buat upload gambar
        $imageName = $carousel->image;

        // 4. kalau upload baru -> ganti gambar lama
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($carousel->image && Storage::disk('public')->exists('carousel/'.$carousel->image)) {
                Storage::disk('public')->delete('carousel/'.$carousel->image);
            }

            // proses upload gambar baru
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('carousel/'.$imageName, (string) $encoded);
        }

        // update data ke db
        $carousel->update([
            'image' => $imageName,
            'title' => $request->title,
        ]);

        // redirect ke index
        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil diupdate');
    }

    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // 1. hapus gambar
        if ($carousel->image && Storage::disk('public')->exists('carousel/'.$carousel->image)) {
            Storage::disk('public')->delete('carousel/'.$carousel->image);
        }

        // 2. hapus data dari database
        $carousel->delete();

        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil dihapus');
    }
}
