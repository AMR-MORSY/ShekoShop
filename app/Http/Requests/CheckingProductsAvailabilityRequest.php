<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CheckingProductsAvailabilityRequest extends FormRequest
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
            "products"=> 'required|array',
            'products.*.quantity'=>['required','numeric','min:1','max:100'],////////we must but numeric validation to make min& max validation work
            "products.*.id"=>'required|exists:products,id',
            'products.*.size'=>['required',Rule::in([500,1000,250])],
         
           
        ];
    }
}
