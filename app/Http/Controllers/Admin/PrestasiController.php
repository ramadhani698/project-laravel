<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;
use Intervention\Image\Laravel\Facades\Image;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::orderBy('tahun', 'desc')->get();
        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        // 1. validasi
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240',
            'judul' => 'required|string',
            'juara' => 'required|string',
            'nama_siswa' => 'required|string',
            'deskripsi' => 'required|string',
            'tahun' => 'required|numeric|digits:4',
        ]);

        // 2. siapin tempat upload gambar
        $imageName = null;

        // 3. upload gambar
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/prestasi');

            // kalo folder nya belum ada
            if(!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 4. simpan ke db
        Prestasi::create([
            'image' => $imageName,
            'judul' => $request->judul,
            'juara' => $request->juara,
            'nama_siswa' => $request->nama_siswa,
            'deskripsi' => $request->deskripsi,
            'tahun' => $request->tahun,
        ]);

        // 5. redirect
        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        // 1. cari id
        $prestasi = Prestasi::findOrFail($id);

        // 2. validasi
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'judul' => 'required|string',
            'juara' => 'required|string',
            'nama_siswa' => 'required|string',
            'deskripsi' => 'required|string',
            'tahun' => 'required|numeric|digits:4',
        ]);

        // 3. siapin tempat gambar
        $imageName = $prestasi->image;

        // 4. upload gambar
        if($request->hasFile('image')) {

            // hapus gambar lama
            $oldPath = public_path('uploads/prestasi/'.$prestasi->image);
            if(file_exists($oldPath)) {
                unlink($oldPath);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/prestasi');

            // kalo folder nya blm ada
            if(!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. update db
        $prestasi->update([
            'image' => $imageName,
            'judul' => $request->judul,
            'juara' => $request->juara,
            'nama_siswa' => $request->nama_siswa,
            'deskripsi' => $request->deskripsi,
            'tahun' => $request->tahun,
        ]);

        // 6. redirect
        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil diupdate');
    }

    public function destroy($id)
    {
        // 1. cari id
        $prestasi = Prestasi::findOrFail($id);

        // 2. hapus gambar dari folder
        $imagePath = public_path('uploads/prestasi/'.$prestasi->image);
        if(file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. hapus data dari db
        $prestasi->delete();

        // 4. redirect
        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }
}
