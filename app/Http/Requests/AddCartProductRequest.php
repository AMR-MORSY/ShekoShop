<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCartProductRequest extends FormRequest
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
            'product.id'=>['exists:products,id'],
            'price'=>["required", 'integer'],
            'size'=>['exists:sizes,id'],
            'quantity'=>['required','integer','min:1'],
            "options.*"=>['nullable','exists:options,id']
        ];
    }
}
