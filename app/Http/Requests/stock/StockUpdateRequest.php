<?php

namespace App\Http\Requests\stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockUpdateRequest extends FormRequest
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
            'is_active'=>['boolean'],
            'price'=>['numeric','min:0']
        ];
    }
}
