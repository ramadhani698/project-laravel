<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil semua data jurusan
        $jurusans = Jurusan::orderBy('order', 'asc')->get();
        
        // kirim data ke view
        return view('admin.jurusan.index', compact('jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // tampilkan form create
        return view('admin.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi form dulu
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'about' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'order' => 'required|integer',
        ]);

        // 2. variabel untuk nama gambar
        $imageName = null;

        // 3. proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/jurusan');

            // kalau folder nya belum di buat
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // simpan data ke db
        Jurusan::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'about' => $request->about,
            'image' => $imageName,
            'order' => $request->order,
        ]);

        // redirect ke index
        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. cek id yg mau di edit
        $jurusan = Jurusan::findOrFail($id);

        // 2. kirim data ke view
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. temukan ID
        $jurusan = Jurusan::findOrFail($id);

        // 2. validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'about' => 'required|string',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
        ]);

        // 3. siapin nama gambar lama (default)
        $imageName = $jurusan->image;

        // 4. kalo upload gambar baru
        if ($request->hasFile('image')) {
            
            // hapus file fisik gambar lama
            $oldPath = public_path('uploads/jurusan/'.$jurusan->image);
            if ($jurusan->image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // upload gambar baru
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/jurusan');

            // kalau folder nya belum di buat
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. update data ke db
        $jurusan->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'about' => $request->about,
            'order' => $request->order,
            'image' => $imageName,
        ]);

        // redirect ke index
        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. cari id
        $jurusan = Jurusan::findOrFail($id);

        // 2. hapus gambar dari folder
        $imagePath = public_path('uploads/jurusan/' . $jurusan->image);
        if ($jurusan->image && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. hapus data dari jurusan
        // data anak (head, visi misi, galeri) juga ikut terhapus
        $jurusan->delete();

        // 4. redirect ke index
        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus');
    }
}
