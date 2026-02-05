<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::where('status', 'publish')
            ->orderByDesc('published_at')
            ->paginate(6);
        
        return view('frontend.informasi.berita', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        return view('frontend.berita.show', compact('berita'));
    }
}
