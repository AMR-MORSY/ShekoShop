<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

     protected function prepareForValidation()
     {
        $this->merge([
            "slug"=>Str::slug($this->product_name,'-')

        ]);
     }
    public function rules(): array
    {
        return [
            "product_name" => ["required", "string", "max:100"],
             "product_price" => ["required", "numeric"],
             "product_stock" => ["required", "numeric"],
             "product_cartDesc" => ["required", "string", "max:200"],
            "product_shortDesc" => ["required", "string", "max:200"],
             "slug" => ["required", "string", "max:100", Rule::unique("products")->ignore($this->product)],
              "discount_id"=>["nullable","exists:discounts,id"],
            "category_id" => ["required", "exists:categories,id"],
            "product_live"=>['required','in:0,1'],
             "images" => [Rule::requiredIf(function () {
                 return $this->routeIs("product.store");
            }), "nullable","array"],
             "images.*"=>[File::image()->max(12*1024)]


        ];
    }
}
