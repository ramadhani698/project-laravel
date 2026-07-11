<?php

namespace App\Models\Ppdb;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PpdbPendaftar extends Authenticatable
{
    use Notifiable;

    protected $table = 'ppdb_pendaftars';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_hp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function formulir()
    {
        return $this->hasOne(PpdbFormulirPendaftaran::class, 'ppdb_pendaftar_id');
    }

    public function berkas()
    {
        return $this->hasMany(PpdbBerkas::class, 'ppdb_pendaftar_id');
    }
}