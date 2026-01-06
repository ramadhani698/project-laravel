<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'published_at',
        'status',
    ];

    // casting tipe data
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // scope: cuma berita yang udah di publish
    public function scopePublished(Builder $query)
    {
        return $query
            ->where('status', 'publish')
            ->where(function ($q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }
}
