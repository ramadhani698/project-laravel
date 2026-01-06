<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vision;
use Intervention\Image\Laravel\Facades\Image;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visions = Vision::orderBy('id', 'asc')->get();
        return view('admin.vision.index', compact('visions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vision.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi data
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'vision' => 'required|string|max:255',
            'mission' => 'required|string',
        ]);

        // 2. ubah string jadi array
        $missionArray = array_filter(
            array_map('trim', preg_split("/\r\n|\n|\r/", $request->mission))
        );

        // 3. siapin variabel gambar
        $imageName = null;

        // 4. cek gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/vision');

            // kalo folder nya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. simpan ke db
        Vision::create([
            'image' => $imageName,
            'vision' => $request->vision,
            'mission' => $missionArray,
        ]);

        // 6. redirect ke index
        return redirect()
            ->route('admin.vision.index')
            ->with('success', ' Data Visi Misi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 1. cek id
        $vision = Vision::findOrFail($id);
        return view('admin.vision.edit', compact('vision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. cek id
        $vision = Vision::findOrFail($id);

        // 2. validasi data
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'vision' => 'required|string|max:255',
            'mission' => 'required|string',
        ]);
        
        // 3. ubah string jadi array
        $missionArray = array_filter(
            array_map('trim', preg_split("/\r\n|\n|\r/", $request->mission))
        );

        // 4. siapin variabel gambar
        $imageName = $vision->image;

        // 5. cek gambar
        if ($request->hasFile('image')) {
            // hapus gambar lama
            $oldPath = public_path('uploads/vision/'.$imageName);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // simpan gambar baru
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/vision');

            // kalo foldernya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. simpan ke db
        $vision->update([
            'image' => $imageName,
            'vision' => $request->vision,
            'mission' => $missionArray,
        ]);

        // 6. redirect ke index
        return redirect()
            ->route('admin.vision.index')
            ->with('success', ' Data Visi Misi berhasil diupdate');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. cek id
        $vision = Vision::findOrFail($id);

        // 2. hapus gambar
        $imagePath = public_path('uploads/vision/'.$vision->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 3. hapus data
        $vision->delete();

        // 4. redirect ke index
        return redirect()
            ->route('admin.vision.index')
            ->with('success', ' Data Visi Misi berhasil dihapus');
    }
}
