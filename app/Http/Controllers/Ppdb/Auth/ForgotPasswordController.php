<?php

namespace App\Http\Controllers\Ppdb\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb\PpdbPendaftar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Step 1: Tampilkan form verifikasi data (email + no hp).
     */
    public function showVerifyForm()
    {
        return view('ppdb.auth.lupa-password-verify');
    }

    /**
     * Step 1: Cocokkan email + no hp ke database.
     */
    public function verify(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'no_hp' => ['required', 'string'],
        ]);

        $pendaftar = PpdbPendaftar::where('email', $validated['email'])
            ->where('no_hp', $validated['no_hp'])
            ->first();

        if (! $pendaftar) {
            throw ValidationException::withMessages([
                'email' => 'Email dan No. HP tidak cocok dengan data yang terdaftar.',
            ]);
        }

        // Simpan flag verifikasi ke session, valid untuk 1x proses reset
        $request->session()->put('ppdb_reset_verified_id', $pendaftar->id);

        return redirect()->route('ppdb.auth.lupa-password.reset');
    }

    /**
     * Step 2: Tampilkan form set password baru (hanya jika sudah terverifikasi).
     */
    public function showResetForm(Request $request)
    {
        if (! $request->session()->has('ppdb_reset_verified_id')) {
            return redirect()
                ->route('ppdb.auth.lupa-password.verify')
                ->with('error', 'Silakan verifikasi data diri terlebih dahulu.');
        }

        return view('ppdb.auth.lupa-password-reset');
    }

    /**
     * Step 2: Update password baru.
     */
    public function resetPassword(Request $request)
    {
        $pendaftarId = $request->session()->get('ppdb_reset_verified_id');

        if (! $pendaftarId) {
            return redirect()
                ->route('ppdb.auth.lupa-password.verify')
                ->with('error', 'Sesi verifikasi telah berakhir, silakan ulangi.');
        }

        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $pendaftar = PpdbPendaftar::findOrFail($pendaftarId);
        $pendaftar->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->session()->forget('ppdb_reset_verified_id');

        return redirect()
            ->route('ppdb.auth.login')
            ->with('success', 'Kata sandi berhasil diubah. Silakan masuk dengan kata sandi baru.');
    }
}
