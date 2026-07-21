<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbJawabanPendaftar extends Model
{
    protected $table = 'ppdb_jawaban_pendaftars';

    protected $fillable = [
        'formulir_pendaftaran_id',
        'soal_tes_id',
        'jawaban_dipilih',
    ];
    
    public function formulirPendaftaran(): BelongsTo
    {
        return $this->belongsTo(PpdbFormulirPendaftaran::class, 'formulir_pendaftaran_id');
    }

    public function soalTes(): BelongsTo
    {
        return $this->belongsTo(PpdbSoalTes::class, 'soal_tes_id');
    }
    
}
