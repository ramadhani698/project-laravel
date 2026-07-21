<?php

namespace App\Http\Requests\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class UploadBerkasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_dokumen' => [
                'required',
                'in:ktp_ortu,akta_kelahiran,kartu_keluarga,ijazah,skl,rapor_semester_akhir,surat_keterangan_sehat',
            ],
            'file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Format file harus PDF, JPG, JPEG, PNG, atau WEBP.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}