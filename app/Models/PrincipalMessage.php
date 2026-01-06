<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrincipalMessage extends Model
{
    protected $table = 'principal_messages';

    protected $fillable = [
        'title',
        'header_image',
        'photo',
        'greeting',
        'content',
        'position',
        'nama',
    ];
}
