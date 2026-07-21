<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\ProsedurSetting;

class ProsedurController extends Controller
{
    public function index()
    {
        $prosedurs = ProsedurSetting::where('aktif', true)
            ->orderBy('order')
            ->get();

        return view('ppdb.prosedur', compact('prosedurs'));
    }
}