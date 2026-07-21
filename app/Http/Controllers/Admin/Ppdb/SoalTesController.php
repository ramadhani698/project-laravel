<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ppdb\SoalTesRequest;
use App\Models\Ppdb\PpdbSoalTes;
use App\Models\Jurusan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SoalTesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = PpdbSoalTes::with('jurusan');

        if (request('tipe_soal')) {
            $query->where('tipe_soal', request('tipe_soal'));
        }

        if (request('jurusan_id')) {
            $query->where('jurusan_id', request('jurusan_id'));
        }

        if (request('q')) {
            $query->where('pertanyaan', 'like', '%' . request('q') . '%');
        }

        $perPage = (int) request('per_page', 25);
        $soalTes = $query->latest()->paginate($perPage)->withQueryString();

        $jurusans = Jurusan::orderBy('name')->get();

        $totalSoal = PpdbSoalTes::count();
        $totalAkademik = PpdbSoalTes::where('tipe_soal', 'akademik')->count();
        $totalKejuruan = PpdbSoalTes::where('tipe_soal', 'kejuruan')->count();

        return view('admin.ppdb.soal-tes.index', compact(
            'soalTes', 'jurusans', 'totalSoal', 'totalAkademik', 'totalKejuruan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $jurusans = Jurusan::orderBy('name')->get();

        return view('admin.ppdb.soal-tes.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SoalTesRequest $request): RedirectResponse
    {
        PpdbSoalTes::create($request->validated());

        return redirect()
            ->route('admin.ppdb.soal-tes.index')
            ->with('success', 'Soal tes berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PpdbSoalTes $soalTe): View
    {
        $jurusans = Jurusan::orderBy('name')->get();

        return view('admin.ppdb.soal-tes.edit', compact('soalTe', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SoalTesRequest $request, PpdbSoalTes $soalTe): RedirectResponse
    {
        $soalTe->update($request->validated());

        return redirect()
            ->route('admin.ppdb.soal-tes.index')
            ->with('success', 'Soal tes berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PpdbSoalTes $soalTe): RedirectResponse
    {
        $soalTe->delete();

        return redirect()
            ->route('admin.ppdb.soal-tes.index')
            ->with('success', 'Soal tes berhasil dihapus.');
    }
}
