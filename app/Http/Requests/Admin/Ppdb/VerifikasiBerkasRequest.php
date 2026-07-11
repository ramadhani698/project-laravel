<?php

namespace App\Http\Requests\Admin\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class VerifikasiBerkasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // sudah dihandle middleware auth admin di route
    }

    public function rules(): array
    {
        return [
            'status_verifikasi' => ['required', 'in:valid,ditolak'],
            'catatan_admin' => ['nullable', 'required_if:status_verifikasi,ditolak', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'catatan_admin.required_if' => 'Catatan wajib diisi kalau dokumen ditolak, supaya siswa tahu apa yang perlu diperbaiki.',
        ];
    }
}