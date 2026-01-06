<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
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
        if ($request->hasFile('image')) {                   // cek apakah ada file gambar
            $image = $request->file('image');               // ambil file gambar
            $imageName = time().'.'.$image->extension();    // buat nama file gambar
            $path = public_path('uploads/carousel');        // path folder uploads

            // kalau folder uploads nya belum di buat
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
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
            $oldPath = public_path('uploads/carousel/'.$carousel->image);
            if ($carousel->image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // proses upload gambar baru
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/carousel');

            // kalau folder nya belum di buat
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar nya
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
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
        $imagePath = public_path('uploads/carousel/' . $carousel->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // 2. hapus data dari database
        $carousel->delete();

        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil dihapus');
    }
}
