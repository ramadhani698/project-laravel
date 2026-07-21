<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProsedurSetting extends Model
{
    protected $table = 'prosedur_settings';

    protected $fillable = [
        'label',
        'title',
        'description',
        'order',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'order' => 'integer',
    ];
}
