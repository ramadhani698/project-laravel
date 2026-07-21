<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ppdb\PeriodeTesRequest;
use App\Models\Ppdb\PpdbPeriodeTes;

class PeriodeTesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodeTes = PpdbPeriodeTes::orderByDesc('tanggal_buka_tes')->paginate(10);

        return view('admin.ppdb.periode-tes.index', compact('periodeTes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ppdb.periode-tes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeriodeTesRequest $request)
    {
        PpdbPeriodeTes::create($request->validated());

        return redirect()
            ->route('admin.ppdb.periode-tes.index')
            ->with('success', 'Periode tes berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PpdbPeriodeTes $periodeTe)
    {
        return view('admin.ppdb.periode-tes.edit', ['periodeTes' => $periodeTe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeriodeTesRequest $request, PpdbPeriodeTes $periodeTe)
    {
        $periodeTe->update($request->validated());

        return redirect()
            ->route('admin.ppdb.periode-tes.index')
            ->with('success', 'Periode tes berhasil diperbarui.');
    }

    public function toggleAktif(PpdbPeriodeTes $periodeTe)
    {
        if (! $periodeTe->is_aktif) {
            $adaPeriodeAktifLain = PpdbPeriodeTes::where('is_aktif', true)
                ->where('id', '!=', $periodeTe->id)
                ->exists();

            if ($adaPeriodeAktifLain) {
                return redirect()
                    ->route('admin.ppdb.periode-tes.index')
                    ->with('error', 'Sudah ada periode tes lain yang aktif. Nonaktifkan periode tersebut terlebih dahulu.');
            }
        }

        $periodeTe->update(['is_aktif' => ! $periodeTe->is_aktif]);

        $pesan = $periodeTe->fresh()->is_aktif
            ? 'Periode tes berhasil diaktifkan.'
            : 'Periode tes berhasil dinonaktifkan.';

        return redirect()
            ->route('admin.ppdb.periode-tes.index')
            ->with('success', $pesan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PpdbPeriodeTes $periodeTe)
    {
        $periodeTe->delete();

        return redirect()
            ->route('admin.ppdb.periode-tes.index')
            ->with('success', 'Periode tes berhasil dihapus.');
    }
}
