<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $pendaftar = auth('ppdb')->user();

        return view('ppdb.dashboard.index', compact('pendaftar'));
    }
}