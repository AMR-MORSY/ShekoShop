<?php

namespace App\Http\Requests\Products;

use App\Models\User;
use App\Models\Product_Catogory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    protected $errorBag = 'store_product';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        if ($user->hasRole('admin')) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "product_SKU" => 'nullable|string|max:50',
            'product_name' => 'required|string|max:100',
            'product_price' => 'required|numeric',
            'product_weight' => 'nullable|numeric',
            'product_cartDesc' => 'required|string|max:250',
            'product_shortDesc' => 'required|string|max:1000',
            'product_longDesc' => 'required|string',
            'product_thumb' => 'nullable|string|max:100',
            'category_id' => 'required|string|exists:categories,category_name',
            'color' => 'required|exists:colors,id',
            'size' => 'required|exists:sizes,id',
            'images.*.*' => 'required|mimes:jpg,bmp,png',
            'product_live' => 'required|boolean',
            'product_location' => 'nullable|string|max:50',
            'facefront_image' => 'required|image'




        ];
    }
}
