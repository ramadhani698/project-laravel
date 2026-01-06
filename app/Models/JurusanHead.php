<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JurusanHead extends Model
{
    protected $fillable = [
        'jurusan_id',
        'name',
        'title',
        'photo',
    ];
    
    // kepala ini milik 1 jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
