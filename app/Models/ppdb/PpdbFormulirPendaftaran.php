<?php

namespace App\Models\Ppdb;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;

class PpdbFormulirPendaftaran extends Model
{
    protected $table = 'ppdb_formulir_pendaftarans';

    protected $fillable = [
        'ppdb_pendaftar_id',
        'no_pendaftaran',
        'nisn',
        'nik',
        'no_kk',
        'no_akta',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'asal_sekolah',
        'nama_ayah',
        'nik_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'nik_ibu',
        'pekerjaan_ibu',
        'no_hp_ortu',
        'jurusan_id',
        'current_step',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'current_step' => 'integer',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(PpdbPendaftar::class, 'ppdb_pendaftar_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function berkas()
    {
        return $this->hasMany(PpdbBerkas::class, 'ppdb_pendaftar_id', 'ppdb_pendaftar_id');
    }

    public function generateNoPendaftaran(): string
    {
        return \DB::transaction(function () {
            $tahun2 = substr((string) now()->year, 2, 2);

            $last = self::where('no_pendaftaran', 'like', $tahun2 . '%')
                ->lockForUpdate()
                ->orderByDesc('no_pendaftaran')
                ->value('no_pendaftaran');

            $urutan = $last ? ((int) substr($last, 2, 4)) + 1 : 1;

            return $tahun2 . str_pad($urutan, 4, '0', STR_PAD_LEFT);
        });
    }
}
