<?php

namespace App\Http\Requests\Admin\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormulirPendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nisn' => ['nullable', 'digits:10'],
            'nik' => ['nullable', 'digits:16'],
            'no_kk' => ['nullable', 'digits:16'],
            'no_akta' => ['nullable', 'string', 'max:50'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:Laki-laki,Perempuan'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'nama_ayah' => ['nullable', 'string', 'max:255'],
            'nik_ayah' => ['nullable', 'digits:16'],
            'pekerjaan_ayah' => ['nullable', 'string', 'max:100'],
            'nama_ibu' => ['nullable', 'string', 'max:255'],
            'nik_ibu' => ['nullable', 'digits:16'],
            'pekerjaan_ibu' => ['nullable', 'string', 'max:100'],
            'no_hp_ortu' => ['nullable', 'string', 'max:20'],
            'jurusan_id' => ['nullable', 'exists:jurusans,id'],
        ];
    }
}