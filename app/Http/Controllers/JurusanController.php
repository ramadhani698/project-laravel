<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function show($slug)
    {
        $jurusan = Jurusan::with(['head', 'visiMisi', 'galleries'])
        ->where('slug', $slug)
        ->firstOrFail();

        return view('frontend.jurusan.show', compact('jurusan'));
    }
}
