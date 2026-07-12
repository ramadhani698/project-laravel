<?php

namespace App\Models\ppdb;

use Illuminate\Database\Eloquent\Model;

class PpdbFiturProsedur extends Model
{
    protected $table = 'ppdb_fitur_prosedurs';

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
    //

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
