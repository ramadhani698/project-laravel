<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbHasilSeleksi extends Model
{
    protected $table = 'ppdb_hasil_seleksis';

    protected $fillable = [
        'formulir_pendaftaran_id',
        'nilai_akademik',
        'nilai_kejuruan',
        'status_kelulusan',
        'catatan_admin',
        'tanggal_pengumuman',
    ];

    protected $casts = [
        'nilai_akademik' => 'decimal:2',
        'nilai_kejuruan' => 'decimal:2',
        'tanggal_pengumuman' => 'date',
    ];

    public function formulirPendaftaran(): BelongsTo
    {
        return $this->belongsTo(PpdbFormulirPendaftaran::class, 'formulir_pendaftaran_id');
    }
}
