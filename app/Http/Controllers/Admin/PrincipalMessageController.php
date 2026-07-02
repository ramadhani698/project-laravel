<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrincipalMessage;
use Illuminate\Support\Facades\Storage;
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
            $headerImageName = time().'_'.uniqid().'.'.$headerImage->extension();

            $encoded = Image::read($headerImage)->encodeByExtension($headerImage->extension(), quality: 75);
            Storage::disk('public')->put('principal-message/header-image/'.$headerImageName, (string) $encoded);
        }

        // cek photo(photo)
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$photo->extension();

            $encoded = Image::read($photo)->encodeByExtension($photo->extension(), quality: 75);
            Storage::disk('public')->put('principal-message/photo/'.$photoName, (string) $encoded);
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
            if ($headerImageName && Storage::disk('public')->exists('principal-message/header-image/'.$headerImageName)) {
                Storage::disk('public')->delete('principal-message/header-image/'.$headerImageName);
            }

            // simpan header image baru
            $headerImage = $request->file('header_image');
            $headerImageName = time().'_'.uniqid().'.'.$headerImage->extension();

            $encoded = Image::read($headerImage)->encodeByExtension($headerImage->extension(), quality: 75);
            Storage::disk('public')->put('principal-message/header-image/'.$headerImageName, (string) $encoded);
        }

        // cek photo(photo)
        if ($request->hasFile('photo')) {
            // hapus photo lama
            if ($photoName && Storage::disk('public')->exists('principal-message/photo/'.$photoName)) {
                Storage::disk('public')->delete('principal-message/photo/'.$photoName);
            }

            // simpan photo baru
            $photo = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$photo->extension();

            $encoded = Image::read($photo)->encodeByExtension($photo->extension(), quality: 75);
            Storage::disk('public')->put('principal-message/photo/'.$photoName, (string) $encoded);
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
        if ($principalMessage->header_image && Storage::disk('public')->exists('principal-message/header-image/'.$principalMessage->header_image)) {
            Storage::disk('public')->delete('principal-message/header-image/'.$principalMessage->header_image);
        }

        // hapus photo
        if ($principalMessage->photo && Storage::disk('public')->exists('principal-message/photo/'.$principalMessage->photo)) {
            Storage::disk('public')->delete('principal-message/photo/'.$principalMessage->photo);
        }

        // 2. hapus db
        $principalMessage->delete();

        // 3. redirect ke index
        return redirect()
            ->route('admin.principal-message.index')
            ->with('success', 'Kata kepala sekolah berhasil dihapus');
    }
}
