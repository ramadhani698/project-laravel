<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Jurusan;
use App\Models\Prestasi;
use App\Models\Gallery;
use App\Models\Statistik;
use App\Models\Sarpras;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalJurusan = Jurusan::count();
        $totalPrestasi = Prestasi::count();
        $totalGallery = Gallery::count();
        $statistiks = Statistik::orderBy('id', 'asc')->get();
        $totalFasilitas = Sarpras::count();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalJurusan',
            'totalPrestasi',
            'totalGallery',
            'statistiks',
            'totalFasilitas'
        ));
    }
}
