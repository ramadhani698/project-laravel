<?php

namespace App\Http\Controllers;

use App\Models\BerandaSetting;
use Illuminate\Http\Request;

class PpdbBerandaController extends Controller
{
    public function index()
    {
        $settings = BerandaSetting::current();

        return view('ppdb.home', [
            'settings' => $settings,
        ]);
    }
}