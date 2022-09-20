<?php

namespace App\Http\Requests\cart;

use Illuminate\Foundation\Http\FormRequest;

class deleteCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "quantity"=>['required','integer'],
            "product_id"=>'required|exists:products,id',
            "size"=>'nullable|exists:sizes,id',
            "color"=>'nullable|exists:colors,id'
        ];
    }
}
