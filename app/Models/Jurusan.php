<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'about',
        'image',
        'order',
    ];

    protected $casts = [
        'misi' => 'array',
    ];

    // 1 jurusan punya 1 kepala kompentsi
    public function head()
    {
        return $this->hasOne(JurusanHead::class); //kepala jurusan -> 1 pake hasOne
    }

    // 1 jurusan punya 1 visi misi
    public function visiMisi()
    {
        return $this->hasOne(JurusanVisiMisi::class);
    }

    // 1 jurusan punya banyak galeri
    public function galleries()
    {
        return $this->hasMany(JurusanGallery::class); //galeri -> banyak = pake hasMany
    }
}
