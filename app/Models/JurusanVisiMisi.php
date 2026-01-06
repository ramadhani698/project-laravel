<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanVisiMisi extends Model
{
    protected $table = 'jurusan_visi_misi';

    protected $fillable = [
        'jurusan_id',
        'visi',
        'misi',
    ];

    protected $casts = [
        'misi' => 'array',
    ];

    // visi misi ini milik 1 jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
