<?php

namespace App\Http\Requests\Nasabah;

use App\Exceptions\CustomFailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama nasabah harus di isi',
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
        else{
            $errors = implode('<br>', $validator->errors()->all());
            alert()->html('Gagal', $errors, 'error');
            $this->redirect = route('dashboard.nasabah.create');
        }

        parent::failedValidation($validator);
    }
}
