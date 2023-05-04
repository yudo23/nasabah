<?php

namespace App\Http\Requests\Transaction;

use App\Exceptions\CustomFailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'nasabah_id' => [
                'required', 
                Rule::exists('nasabahs', 'id')
            ],
            'date' => [
                'required',
                'date_format:Y-m-d H:i:s',
            ],
            'description' => [
                'required',
                'in:Tarik Tunai,Setor Tunai,Beli Pulsa,Bayar Listrik'
            ],
            'debit_credit_status' => [
                'required',
                'in:C,D'
            ],
            'amount' => [
                'required', 
                'min:0', 
                'numeric'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nasabah_id.required' => 'Nasabah wajib dipilih',
            'nasabah_id.exists' => 'Nasabah tidak ditemukan',
            'description.required' => 'Deskripsi wajib dipilih',
            'description.in' => 'Deskripsi tidak valid',
            'date.required' => 'Tanggal transaksi wajib dipilih',
            'date.date_format' => 'Tanggal transaksi tidak valid',
            'debit_credit_status.required' => 'Tipe transaksi wajib dipilih',
            'debit_credit_status.in' => 'Tipe transaksi tidak valid',
            'amount.required' => 'Jumlah transaksi harus di isi',
            'amount.numeric' => 'Jumlah transaksi harus berupa angka',
            'amount.min' => 'Jumlah transaksi minimal 1',
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
