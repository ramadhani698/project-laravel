<?php

namespace App\Http\Requests\Admin\Ppdb;

use App\Models\Ppdb\PpdbPeriodeTes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PeriodeTesRequest extends FormRequest
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
            'nama_periode' => ['required', 'string', 'max:255'],
            'tanggal_buka_tes' => ['required', 'date'],
            'tanggal_tutup_tes' => ['required', 'date', 'after:tanggal_buka_tes'],
            'is_aktif' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_aktif' => $this->boolean('is_aktif'),
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (! $this->boolean('is_aktif')) {
                return;
            }

            $adaPeriodeAktifLain = PpdbPeriodeTes::where('is_aktif', true)
                ->when(
                    $this->route('periode_te'),
                    fn ($query, $periodeTe) => $query->where('id', '!=', $periodeTe->id)
                )
                ->exists();

            if ($adaPeriodeAktifLain) {
                $validator->errors()->add(
                    'is_aktif',
                    'Sudah ada periode tes lain yang aktif. Nonaktifkan periode tersebut terlebih dahulu.'
                );
            }
        });
    }
}
