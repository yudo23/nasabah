<?php

namespace App\Http\Requests\Report;

use App\Exceptions\CustomFailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'nasabah_id' => [
                'required', 
                Rule::exists('nasabahs', 'id')
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nasabah_id.required' => 'Nasabah wajib dipilih',
            'nasabah_id.exists' => 'Nasabah tidak ditemukan',
            'start_date.required' => 'Tanggal mulai wajib dipilih',
            'start_date.date_format' => 'Tanggal mulai tidak valid',
            'end_date.required' => 'Tanggal selesai wajib dipilih',
            'end_date.date_format' => 'Tanggal selesai tidak valid',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws CustomFailedValidationException
     */
    public function failedValidation(Validator $validator): void
    {
        if ($this->wantsJson()) {
            throw new CustomFailedValidationException(implode(', ', $validator->errors()->all()), 422);
        }

        parent::failedValidation($validator);
    }
}
