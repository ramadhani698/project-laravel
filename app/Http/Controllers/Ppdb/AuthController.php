<?php

namespace App\Http\Controllers\Ppdb;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ppdb\LoginRequest;
use App\Http\Requests\Ppdb\RegisterRequest;
use App\Models\Ppdb\PpdbPendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('ppdb.auth.daftar'); // sebelumnya 'ppdb.auth.register'
    }

    public function register(RegisterRequest $request)
    {
        $pendaftar = PpdbPendaftar::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('ppdb')->login($pendaftar);

        return redirect()
            ->route('ppdb.dashboard')
            ->with('success', 'Akun berhasil dibuat, selamat datang ' . $pendaftar->nama_lengkap . '!');
    }

    public function showLogin()
    {
        return view('ppdb.auth.login'); // ini sudah cocok, tidak berubah
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('ppdb')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('ppdb.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'Email atau kata sandi salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('ppdb')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('ppdb.auth.login'); // sebelumnya 'ppdb.login', tidak sesuai nested group
    }
}