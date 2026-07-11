<?php

namespace App\Models\Ppdb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PpdbBerkas extends Model
{
    protected $table = 'ppdb_berkas';

    protected $fillable = [
        'ppdb_pendaftar_id',
        'jenis_dokumen',
        'nama_asli',
        'file_path',
        'ukuran',
        'status_verifikasi',
        'catatan_admin',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(PpdbPendaftar::class, 'ppdb_pendaftar_id');
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    public function scopeBelumValid($query)
    {
        return $query->where('status_verifikasi', '!=', 'valid');
    }
}