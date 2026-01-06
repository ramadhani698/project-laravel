<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = [
        'image',
        'vision',
        'mission',
    ];

    protected $casts = [
        'mission' => 'array',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('uploads/vision/'.$this->image)
            : asset('images/jurusan.jpg');
    }
}
