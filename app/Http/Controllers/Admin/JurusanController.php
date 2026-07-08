<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'about' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'order' => 'required|integer',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('jurusan/'.$imageName, (string) $encoded);
        }

        // simpan ke variabel $jurusan (sebelumnya tidak ditampung)
        $jurusan = Jurusan::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'about' => $request->about,
            'image' => $imageName,
            'order' => $request->order,
        ]);

        // redirect ke wizard step 2 (Kepala Kompetensi), bukan langsung ke index
        return redirect()
            ->route('admin.jurusan.wizard.head', $jurusan->id)
            ->with('success', 'Jurusan berhasil ditambahkan. Sekarang lengkapi data pendukungnya.');
    }

    /**
     * WIZARD STEP 2 — Form Kepala Kompetensi
     */
    public function wizardHead(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.wizard-head', compact('jurusan'));
    }

    /**
     * WIZARD STEP 3 — Form Visi & Misi
     */
    public function wizardVisiMisi(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.wizard-visi-misi', compact('jurusan'));
    }

    /**
     * WIZARD STEP 4 — Form Galeri
     */
    public function wizardGallery(string $id)
    {
        $jurusan = Jurusan::findOrFail($id)->load('galleries');
        return view('admin.jurusan.wizard-gallery', compact('jurusan'));
    }

    /**
     * WIZARD SELESAI — redirect ke index dengan pesan sukses lengkap
     */
    public function wizardFinish(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        return redirect()
            ->route('admin.jurusan.index')
            ->with('success', "Jurusan \"{$jurusan->name}\" berhasil ditambahkan lengkap dengan data pendukungnya.");
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

            // hapus file lama
            if ($jurusan->image && Storage::disk('public')->exists('jurusan/'.$jurusan->image)) {
                Storage::disk('public')->delete('jurusan/'.$jurusan->image);
            }

            // upload gambar baru
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->extension();

            $encoded = Image::read($image)->encodeByExtension($image->extension(), quality: 75);
            Storage::disk('public')->put('jurusan/'.$imageName, (string) $encoded);
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

        // 2. hapus gambar
        if ($jurusan->image && Storage::disk('public')->exists('jurusan/'.$jurusan->image)) {
            Storage::disk('public')->delete('jurusan/'.$jurusan->image);
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
