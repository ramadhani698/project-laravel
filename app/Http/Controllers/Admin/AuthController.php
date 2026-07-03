<?php

namespace App\Http\Controllers\Admin\Ppdb;

use App\Http\Controllers\Controller;
use App\Models\Ppdb\PpdbPendaftar;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = PpdbPendaftar::latest()->paginate(15);

        return view('admin.ppdb.pendaftar.index', compact('pendaftars'));
    }
}