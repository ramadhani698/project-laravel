<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;

    /**
     * Nilai default saat instance baru dibuat tanpa mengisi kolom ini.
     * Dipakai sebagai pengganti default value di database, karena
     * MySQL tidak mengizinkan default value pada kolom JSON.
     */
    protected $table = 'persyaratan';
    protected $attributes = [
        'format_diizinkan' => '["jpg","jpeg","pdf"]',
    ];

    protected $fillable = [
        'nama_dokumen',
        'keterangan',
        'wajib',
        'format_diizinkan',
        'maksimal_ukuran_kb',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'wajib' => 'boolean',
        'is_active' => 'boolean',
        'format_diizinkan' => 'array',
        'maksimal_ukuran_kb' => 'integer',
        'urutan' => 'integer',
    ];

    /**
     * Scope untuk mengambil dokumen yang aktif saja, terurut sesuai kolom urutan.
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}