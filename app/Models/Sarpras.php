<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'order',
    ];
}
