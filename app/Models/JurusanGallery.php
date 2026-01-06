<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanGallery extends Model
{
    protected $fillable = [
        'jurusan_id',
        'image',
        'order',
    ];
    
    // galeri ini milik 1 jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
