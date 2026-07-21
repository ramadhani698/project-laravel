<?php

namespace App\Http\Requests\Ppdb;

use Illuminate\Foundation\Http\FormRequest;

class SoalTesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Kalau tipe soal akademik, pastikan jurusan_id dikosongkan
        // biar nggak ada soal akademik yang ke-assign ke jurusan tertentu
        if ($this->tipe_soal === 'akademik') {
            $this->merge(['jurusan_id' => null]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tipe_soal' => ['required', 'in:akademik,kejuruan'],
            'jurusan_id' => [
                'nullable',
                'required_if:tipe_soal,kejuruan',
                'exists:jurusans,id',
            ],
            'pertanyaan' => ['required', 'string'],
            'opsi_a' => ['required', 'string', 'max:255'],
            'opsi_b' => ['required', 'string', 'max:255'],
            'opsi_c' => ['required', 'string', 'max:255'],
            'opsi_d' => ['required', 'string', 'max:255'],
            'kunci_jawaban' => ['required', 'in:a,b,c,d'],
        ];
    }

    public function messages(): array
    {
        return [
            'jurusan_id.required_if' => 'Jurusan wajib dipilih untuk soal tipe kejuruan.',
        ];
    }
}
