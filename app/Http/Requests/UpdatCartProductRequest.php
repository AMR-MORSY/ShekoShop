<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatCartProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user())
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product.id' => ['exists:products,id'],
            'size_price' => ["required", 'integer'],
            'size.id' => ['exists:sizes,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            "options" => ['array'],
            "options.id*" => ['nullable', 'exists:options,id'],
            'extra_quantity_prices' => ["required", 'integer'],
            'product_final_price' => ["required", 'integer']

        ];
    }
}
