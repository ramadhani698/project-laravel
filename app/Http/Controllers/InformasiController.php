<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sarpras;

class InformasiController extends Controller
{
    public function sarpras()
    {
        $sarpras = Sarpras::orderBy('order', 'asc')->get();
        return view('frontend.informasi.sarpras', compact('sarpras'));
    }
}
