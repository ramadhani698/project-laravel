<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Jurusan;

class PpdbSoalTes extends Model
{
    protected $table = 'ppdb_soal_tes';

    protected $fillable = [
        'jurusan_id',
        'tipe_soal',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban',
    ];

    protected $hidden = [
        'kunci_jawaban',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function jawabanPendaftar(): HasMany
    {
        return $this->hasMany(PpdbJawabanPendaftar::class, 'soal_tes_id');
    }

    public function scopeAkademik($query)
    {
        return $query->where('tipe_soal', 'akademik');
    }
    
    public function scopeKejuruan($query, ?int $jurusanId = null)
    {
        return $query->where('tipe_soal', 'kejuruan')
            ->when($jurusanId, fn ($q) => $q->where('jurusan_id', $jurusanId));
    }
}