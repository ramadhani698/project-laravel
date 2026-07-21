<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\ProsedurSetting;
use Illuminate\Http\Request;
    
class ProsedurSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prosedurs = ProsedurSetting::orderBy('order')->get();
        return view('admin.prosedur-setting.index', compact('prosedurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prosedur-setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'       => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'nullable|integer',
            'aktif'       => 'nullable|boolean',
        ]);

        ProsedurSetting::create([
            'label'       => $validated['label'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'order'       => $validated['order'] ?? 0,
            'aktif'       => $request->boolean('aktif'),
        ]);

        return redirect()
            ->route('admin.prosedur-setting.index')
            ->with('success', 'Prosedur berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prosedur = ProsedurSetting::findOrFail($id);
        return view('admin.prosedur-setting.show', compact('prosedur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prosedur = ProsedurSetting::findOrFail($id);
        return view('admin.prosedur-setting.edit', compact('prosedur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prosedur = ProsedurSetting::findOrFail($id);

        $validated = $request->validate([
            'label'       => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'nullable|integer',
            'aktif'       => 'nullable|boolean',
        ]);

        $prosedur->update([
            'label'       => $validated['label'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'order'       => $validated['order'] ?? $prosedur->order,
            'aktif'       => $request->boolean('aktif'),
        ]);

        return redirect()
            ->route('admin.prosedur-setting.index')
            ->with('success', 'Prosedur berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prosedur = ProsedurSetting::findOrFail($id);
        $prosedur->delete();

        return redirect()
            ->route('admin.prosedur-setting.index')
            ->with('success', 'Prosedur berhasil dihapus');
    }
}

