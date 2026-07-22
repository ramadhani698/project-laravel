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

        // Simpan flag verifikasi ke session, valid 15 menit untuk 1x proses reset
        $request->session()->put('ppdb_reset_verified_id', $pendaftar->id);
        $request->session()->put('ppdb_reset_expires_at', now()->addMinutes(15)->timestamp);

        return redirect()->route('ppdb.auth.lupa-password.reset');
    }

    /**
     * Step 2: Tampilkan form set password baru (hanya jika sudah terverifikasi).
     */
    public function showResetForm(Request $request)
    {
        $expiresAt = $request->session()->get('ppdb_reset_expires_at', 0);

        if (! $request->session()->has('ppdb_reset_verified_id') || now()->timestamp > $expiresAt) {
            $request->session()->forget(['ppdb_reset_verified_id', 'ppdb_reset_expires_at']);

            return redirect()
                ->route('ppdb.auth.lupa-password.verify')
                ->with('error', 'Sesi verifikasi telah kadaluarsa. Silakan verifikasi ulang data diri Anda.');
        }

        return view('ppdb.auth.lupa-password-reset');
    }

    /**
     * Step 2: Update password baru.
     */
    public function resetPassword(Request $request)
    {
        $pendaftarId = $request->session()->get('ppdb_reset_verified_id');
        $expiresAt = $request->session()->get('ppdb_reset_expires_at', 0);

        if (! $pendaftarId || now()->timestamp > $expiresAt) {
            $request->session()->forget(['ppdb_reset_verified_id', 'ppdb_reset_expires_at']);

            return redirect()
                ->route('ppdb.auth.lupa-password.verify')
                ->with('error', 'Sesi verifikasi telah berakhir atau kadaluarsa, silakan ulangi.');
        }

        $validated = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $pendaftar = PpdbPendaftar::findOrFail($pendaftarId);
        $pendaftar->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->session()->forget(['ppdb_reset_verified_id', 'ppdb_reset_expires_at']);

        return redirect()
            ->route('ppdb.auth.login')
            ->with('success', 'Kata sandi berhasil diubah. Silakan masuk dengan kata sandi baru.');
    }
}