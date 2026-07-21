<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerandaSetting extends Model
{
    protected $fillable = [
    'hero_badge_text',
    'hero_main_title',
    'hero_sub_title',
    'hero_academic_year',
    'hero_date_label',
    'hero_date_value',
    'hero_logo_sub',
    'instagram_url',
    'instagram_handle',
    'whatsapp_number',
    'welcome_heading',
    'welcome_paragraph_1',
    'welcome_paragraph_2',
    'welcome_paragraph_3',
    'address',
    'phone',
    'website_url',
    'email',
    'catatan_persyaratan', // ← tambahan baru
];
    public static function current(): self
    {
        return static::firstOrCreate([], [
            'hero_badge_text'     => 'SPMB ONLINE',
            'hero_main_title'     => 'SPMB',
            'hero_sub_title'      => 'Nama Sekolah',
            'hero_academic_year'  => 'TA. 2026 - 2027',
            'hero_date_label'     => 'GELOMBANG PENDAFTARAN',
            'hero_date_value'     => 'Segera diumumkan',
            'hero_logo_sub'       => 'Kota',
            'welcome_heading'     => 'Selamat Datang',
            'welcome_paragraph_1' => 'Isi paragraf pembuka di sini.',
            'welcome_paragraph_2' => 'Isi paragraf kedua di sini.',
            'welcome_paragraph_3' => 'Isi paragraf ketiga di sini.',
            'address'             => 'Alamat sekolah',
            'phone'               => '08xx-xxxx-xxxx',
            'catatan_persyaratan' => 'Seluruh berkas wajib asli dan sesuai dokumen kependudukan yang berlaku. Berkas tidak lengkap akan menunda proses verifikasi.',
        ]);
    }
}
