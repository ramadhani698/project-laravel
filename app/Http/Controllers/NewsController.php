<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $berita = News::latest()->paginate(9); // maksimal 9 per halaman
        return view('frontend.berita.index', compact('berita'));
    }
}
