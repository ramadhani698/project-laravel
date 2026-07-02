<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        // 1. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|in:draft,publish',
            'published_at' => 'nullable|date',
        ]);

        // 2. variabel buat nama gambar
        $imageName = null;

        // 3. proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            // compress gambar lalu simpan ke disk 'public'
            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('berita/'.$imageName, (string) $encoded);
        }

        // 4. simpan ke db
        Berita::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imageName,
            'status' => $request->status,
            'published_at' => $request->published_at,
        ]);

        // 5. redirect ke index
        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        // 1. cari id
        $berita = Berita::findOrFail($id);

        // 2. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|in:draft,publish',
            'published_at' => 'nullable|date',
        ]);

        // 3. variabel buat nama gambar
        $imageName = $berita->image;

        // 4. kalo upload gambar baru
        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($berita->image && Storage::disk('public')->exists('berita/'.$berita->image)) {
                Storage::disk('public')->delete('berita/'.$berita->image);
            }

            // proses upload gambar baru
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('berita/'.$imageName, (string) $encoded);
        }

        // 5. update ke db
        $berita->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imageName,
            'status' => $request->status,
            'published_at' => $request->published_at,
        ]);

        // 6. redirect ke index
        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function destroy($id)
    {
        // 1. cari id
        $berita = Berita::findOrFail($id);

        // 2. hapus gambar
        if ($berita->image && Storage::disk('public')->exists('berita/'.$berita->image)) {
            Storage::disk('public')->delete('berita/'.$berita->image);
        }

        // 3. hapus dari db
        $berita->delete();

        // 4. redirect ke index
        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
