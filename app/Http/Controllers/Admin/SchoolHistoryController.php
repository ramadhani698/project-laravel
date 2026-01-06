<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolHistory;
use Intervention\Image\Laravel\Facades\Image;

class SchoolHistoryController extends Controller
{
    public function index()
    {
        $histories = SchoolHistory::orderBy('order', 'asc')->get();
        return view('admin.histories.index', compact('histories'));
    }

    public function create()
    {
        return view('admin.histories.create');
    }

    public function store(Request $request)
    {
        // 1. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'position' => 'required|in:left,right',
            'order' => 'nullable|integer',
        ]);

        // 2. siapin tempat buat upload gambar
        $imageName = null;

        // 3. upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/histories');

            // kalo folder nya belum ada, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 4. simpan data ke db
        SchoolHistory::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'position' => $request->position,
            'order' => $request->order ?? 0,
        ]);

        // 5. redirect ke index
        return redirect()
            ->route('admin.histories.index')
            ->with('success', 'Data sejarah berhasil disimpan');
    }

    public function edit($id)
    {
        $history = SchoolHistory::findOrFail($id);
        return view('admin.histories.edit', compact('history'));
    }

    public function update(Request $request, $id)
    {
        // 1. ambil data sejarah
        $history = SchoolHistory::findOrFail($id);

        // 2. validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'position' => 'required|in:left,right',
            'order' => 'nullable|integer',
        ]);

        // 3. siapin tempat gambar lama
        $imageName = $history->image;

        // 4. upload gambar
        if ($request->hasFile('image')) {
            // hapus gambar lama
            $oldPath = public_path('uploads/histories/'.$imageName);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // upload gambar baru
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $path = public_path('uploads/histories');

            // kalo folder nya belum ada, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // compress gambar
            Image::read($image)
                ->save($path.'/'.$imageName, 75);
        }

        // 5. update ke db
        $history->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'position' => $request->position,
            'order' => $request->order ?? 0,
        ]);

        // 6. redirect ke index
        return redirect()
            ->route('admin.histories.index')
            ->with('success', 'Data sejarah berhasil diupdate');
    }

    public function destroy($id)
    {
        // 1. ambil data sejarah
        $history = SchoolHistory::findOrFail($id);

        // 2. hapus gambar
        $imagePath = public_path('uploads/histories/'.$history->image);
        if (file_exists($imagePath)){
            unlink($imagePath);
        }

        // 3. hapus data dari db
        $history->delete();

        // 4. redirect ke index
        return redirect()
            ->route('admin.histories.index')
            ->with('success', 'Data sejarah berhasil dihapus');
    }
}
