<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Keunggulan;
use App\Models\Statistik;
use App\Models\Jurusan;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::get();
        $keunggulans = Keunggulan::orderBy('order', 'asc')->get();
        $statistiks = Statistik::orderBy('order', 'asc')->get();
        $jurusans = Jurusan::orderBy('order', 'asc')
            ->take(3) //section jurusan ringkas
            ->get();
        $beritas = Berita::where('status', 'publish')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('frontend.home', compact('carousels', 'keunggulans', 'statistiks', 'jurusans', 'beritas'));
    }
}
