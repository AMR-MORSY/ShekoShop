<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCartProductsRequest extends FormRequest
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
            "products"=>['array'],
            'products.*.product.id'=>['exists:products,id'],
            'products.*.size_price'=>["required", 'integer'],
            'products.*.size.id'=>['exists:sizes,id'],
            'products.*.quantity'=>['required','integer','min:1'],
            "products.*.options"=>['array'],
            "products.*.options.id*"=>['nullable','exists:options,id'],
            "products.*.extra_quantity_prices"=>['required','integer'],
            "products.*.product_final_price"=>['required','integer']
        ];
    }
}
