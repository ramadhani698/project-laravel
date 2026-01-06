<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrincipalMessage;
use Intervention\Image\Laravel\Facades\Image;

class PrincipalMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $principalMessage = PrincipalMessage::first();
        return view('admin.principal-message.index', compact('principalMessage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.principal-message.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. validasi data
        $request->validate([
            'title' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'greeting' => 'nullable|string',
            'content' => 'required|string',
            'position' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        // 2. siapin variabel gambar
        $headerImageName = null;
        $photoName = null;

        // 3. cek header image(header_image)
        if ($request->hasFile('header_image')) {
            $headerImage = $request->file('header_image');
            $headerImageName = time().'.'.$headerImage->extension();
            $path = public_path('uploads/principal-message/header-image');

            // kalo folder nya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($headerImage)
                ->save($path.'/'.$headerImageName, 75);
        }
        // cek photo(photo)
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time().'.'.$photo->extension();
            $path = public_path('uploads/principal-message/photo');

            // kalo folder nya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($photo)
                ->save($path.'/'.$photoName, 75);
        }

        PrincipalMessage::create([
            'title' => $request->title,
            'header_image' => $headerImageName,
            'photo' => $photoName,
            'greeting' => $request->greeting,
            'content' => $request->content,
            'position' => $request->position,
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('admin.principal-message.index')
            ->with('success', 'Kata kepala sekolah berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $principalMessage = PrincipalMessage::findOrFail($id);
        return view('admin.principal-message.edit', compact('principalMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. cek id
        $principalMessage = PrincipalMessage::findOrFail($id);

        // 2. validasi data
        $request->validate([
            'title' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'greeting' => 'nullable|string',
            'content' => 'required|string',
            'position' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        // 3. siapin variabel gambar
        $headerImageName = $principalMessage->header_image;
        $photoName = $principalMessage->photo;

        // 4. cek header image(header_image)
        if ($request->hasFile('header_image')) {
            // hapus header image lama
            $oldPath = public_path('uploads/principal-message/header-image/'.$headerImageName);
            if ($principalMessage->header_image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // simpan header image baru
            $headerImage = $request->file('header_image');
            $headerImageName = time().'.'.$headerImage->extension();
            $path = public_path('uploads/principal-message/header-image');

            // kalo foldernya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($headerImage)
                ->save($path.'/'.$headerImageName, 75);
        }

        // cek photo(photo)
        if ($request->hasFile('photo')) {
            // hapus photo lama
            $oldPath = public_path('uploads/principal-message/photo/'.$photoName);
            if ($principalMessage->photo && file_exists($oldPath)) {
                unlink($oldPath);
            }
            
            // simpan photo baru
            $photo = $request->file('photo');
            $photoName = time().'.'.$photo->extension();
            $path = public_path('uploads/principal-message/photo');

            // kalo foldernya blm ada
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($photo)
                ->save($path.'/'.$photoName, 75);
        }

        // 5. update db
        $principalMessage->update([
            'title' => $request->title,
            'header_image' => $headerImageName,
            'photo' => $photoName,
            'greeting' => $request->greeting,
            'content' => $request->content,
            'position' => $request->position,
            'nama' => $request->nama,
        ]);

        // 6. redirect ke index
        return redirect()
            ->route('admin.principal-message.index')
            ->with('success', 'Kata kepala sekolah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // 1. cek id
        $principalMessage = PrincipalMessage::findOrFail($id);

        // hapus header image
        $oldHeaderImage = public_path('uploads/principal-message/header-image/'.$principalMessage->header_image);
        if (file_exists($oldHeaderImage)) {
            unlink($oldHeaderImage);
        }

        // hapus photo
        $oldPhoto = public_path('uploads/principal-message/photo/'.$principalMessage->photo);
        if (file_exists($oldPhoto)) {
            unlink($oldPhoto);
        }

        // 2. hapus db
        $principalMessage->delete();
        
        // 3. redirect ke index
        return redirect()
            ->route('admin.principal-message.index')
            ->with('success', 'Kata kepala sekolah berhasil dihapus');
    }
}
