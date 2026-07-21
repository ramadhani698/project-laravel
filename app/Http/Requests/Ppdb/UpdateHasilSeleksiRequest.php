<?php

namespace App\Http\Requests\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHasilSeleksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_kelulusan' => 'required|in:menunggu,lulus,tidak_lulus',
            'catatan_admin' => 'nullable|string',
            'tanggal_pengumuman' => 'nullable|date',
        ];
    }
}
