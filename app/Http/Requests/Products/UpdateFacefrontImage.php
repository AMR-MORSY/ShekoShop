<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacefrontImage extends FormRequest
{
    protected $errorBag='update_facefront';
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
            "facefront_image"=>'required|image',
            'product'=>'required|exists:products,id'
        ];
    }
}
