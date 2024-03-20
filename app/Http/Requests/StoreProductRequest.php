<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            "product_name" => ["required", "string", "max:100"],
            "slug"=>["required",'string','max:300',"unique:products,slug"],
            "product_price" => ["required", 'decimal:2'],
            "product_cartDesc" => ["required", "string", "max:200"],
            "product_shortDesc" => ["required", "string", "max:300"],
            "discount_id"=>["nullable","exists:discounts,id"],
            "category_id" => ["required", "exists:categories,id"],
            "facefront_image" => ["required", "image"],
            "product_live"=>['required', Rule::in([0,1])],
            "product_stock"=>["required", 'decimal:2']
          
        ];
    }
}
