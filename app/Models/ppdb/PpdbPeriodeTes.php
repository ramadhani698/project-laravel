<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;

class PpdbPeriodeTes extends Model
{
    protected $table = 'ppdb_periode_tes';

    protected $fillable = [
        'nama_periode',
        'tanggal_buka_tes',
        'tanggal_tutup_tes',
        'is_aktif',
    ];

    protected $casts = [
        'tanggal_buka_tes' => 'date',
        'tanggal_tutup_tes' => 'date',
        'is_aktif' => 'boolean',
    ];

    /**
     * Ambil periode tes yang lagi aktif saat ini.
     * Dipakai buat cek tombol "Mulai Tes" di dashboard siswa.
     */
    public static function getPeriodeAktifSaatIni(): ?self
    {
        return static::where('is_aktif', true)
            ->whereDate('tanggal_buka_tes', '<=', now())
            ->whereDate('tanggal_tutup_tes', '>=', now())
            ->first();
    }
}
