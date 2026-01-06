<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolHistory;
use App\Models\Vision;
use App\Models\PrincipalMessage;

class ProfilController extends Controller
{
    public function sejarah()
    {
        $histories = SchoolHistory::orderBy('order', 'asc')->get();
        return view('frontend.profil.sejarah', compact('histories'));
    }

    public function visiMisi()
    {
        $vision = Vision::first();
        return view('frontend.profil.visi-misi', compact('vision'));
    }

    public function kataKepsek()
    {
        $principalMessage = PrincipalMessage::first();
        return view('frontend.profil.kata-kepsek', compact('principalMessage'));
    }
}
