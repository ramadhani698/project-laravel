<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PpdbTesAttempts extends Model
{
    protected $table = 'ppdb_tes_attempts';

    protected $fillable = [
        'formulir_pendaftaran_id',
        'periode_tes_id',
        'waktu_mulai',
        'waktu_selesai_mengerjakan',
        'status',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai_mengerjakan' => 'datetime',
    ];

    public function formulirPendaftaran(): BelongsTo
    {
        return $this->belongsTo(PpdbFormulirPendaftaran::class, 'formulir_pendaftaran_id');
    }

    public function periodeTes(): BelongsTo
    {
        return $this->belongsTo(PpdbPeriodeTes::class, 'periode_tes_id');
    }
}
