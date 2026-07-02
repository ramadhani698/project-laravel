<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // compress gambar lalu simpan ke disk 'public'
            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('prestasi/'.$imageName, (string) $encoded);
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
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($prestasi->image && Storage::disk('public')->exists('prestasi/'.$prestasi->image)) {
                Storage::disk('public')->delete('prestasi/'.$prestasi->image);
            }

            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('prestasi/'.$imageName, (string) $encoded);
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

        // 2. hapus gambar
        if ($prestasi->image && Storage::disk('public')->exists('prestasi/'.$prestasi->image)) {
            Storage::disk('public')->delete('prestasi/'.$prestasi->image);
        }

        // 3. hapus data dari db
        $prestasi->delete();

        // 4. redirect
        return redirect()
            ->route('admin.prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }
}
