<?php

namespace App\Http\Requests\stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockSaveRequest extends FormRequest
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
            'company_id'=>['required','integer',Rule::exists('companies','id')],
            'is_active'=>['required','boolean'],
            'price'=>['required','numeric','min:0']
        ];
    }
}
