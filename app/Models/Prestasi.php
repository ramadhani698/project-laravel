<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
        'image',
        'judul',
        'juara',
        'nama_siswa',
        'deskripsi',
        'tahun',
    ];
}
