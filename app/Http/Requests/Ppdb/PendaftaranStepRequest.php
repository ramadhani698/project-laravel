<?php

namespace App\Http\Requests\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranStepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // otorisasi sudah dihandle middleware auth:ppdb di route
    }

    public function rules(): array
    {
        return match ((int) $this->route('step')) {
            1 => [
                'nisn' => ['required', 'digits:10'],
                'nik' => ['required', 'digits:16'],
                'no_kk' => ['required', 'digits:16'],
                'no_akta' => ['required', 'string', 'max:50'],
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'tempat_lahir' => ['required', 'string', 'max:100'],
                'tanggal_lahir' => ['required', 'date', 'before:today'],
                'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
                'alamat' => ['required', 'string', 'max:1000'],
                'asal_sekolah' => ['required', 'string', 'max:255'],
            ],
            2 => [
                'nama_ayah' => ['required', 'string', 'max:255'],
                'nik_ayah' => ['nullable', 'digits:16'],
                'pekerjaan_ayah' => ['required', 'string', 'max:100'],
                'nama_ibu' => ['required', 'string', 'max:255'],
                'nik_ibu' => ['nullable', 'digits:16'],
                'pekerjaan_ibu' => ['required', 'string', 'max:100'],
                'no_hp_ortu' => ['required', 'string', 'max:20'],
            ],
            3 => [
                'jurusan_id' => ['required', 'exists:jurusans,id'],
            ],
            default => [],
        };
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'nisn.digits' => 'NISN harus 10 digit angka.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'no_kk.digits' => 'Nomor KK harus 16 digit angka.',
            'nik_ayah.digits' => 'NIK ayah harus 16 digit angka.',
            'nik_ibu.digits' => 'NIK ibu harus 16 digit angka.',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nisn' => 'NISN',
            'nik' => 'NIK',
            'no_kk' => 'nomor KK',
            'no_akta' => 'nomor akta kelahiran',
            'nama_lengkap' => 'nama lengkap',
            'tempat_lahir' => 'tempat lahir',
            'tanggal_lahir' => 'tanggal lahir',
            'jenis_kelamin' => 'jenis kelamin',
            'alamat' => 'alamat',
            'asal_sekolah' => 'asal sekolah',
            'nama_ayah' => 'nama ayah',
            'nik_ayah' => 'NIK ayah',
            'pekerjaan_ayah' => 'pekerjaan ayah',
            'nama_ibu' => 'nama ibu',
            'nik_ibu' => 'NIK ibu',
            'pekerjaan_ibu' => 'pekerjaan ibu',
            'no_hp_ortu' => 'no. HP orang tua',
            'jurusan_id' => 'jurusan',
        ];
    }
}