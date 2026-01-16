<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;
use App\Models\Gallery;

class InformasiController extends Controller
{
    public function sarpras()
    {
        $sarpras = Sarpras::orderBy('order', 'asc')->get();
        return view('frontend.informasi.sarpras', compact('sarpras'));
    }

    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(9);
        return view('frontend.informasi.gallery', compact('galleries'));
    }
}
