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
            // "product_SKU" => 'nullable|string|max:50',
            'product_name' => 'required|string|max:100',
            'product_price' => 'required|numeric',
            'product_weight' => 'nullable|numeric',
            'product_cartDesc' => 'required|string|max:250',
            'product_shortDesc' => 'required|string|max:1000',
            'product_longDesc' => 'required|string',
            'product_thumb' => 'nullable|string|max:100',
            'category_id' => 'required|string|exists:categories,category_name',
            'devision_id' => 'required|string|exists:devisions,devision_name',
            'type_id' => 'required|string|exists:types,type_name',
            // 'product_live' => 'required|boolean',
            'product_location' => 'nullable|string|max:50',
            'facefront_image' => 'required|image'




        ];
    }

  
    // protected function prepareForValidation()
    // {
    //     $quantities=[];
       
      
    //     foreach($this->quantity as $quant)
    //     {
    //         $quant_arry= explode(',',$quant,200);
    //         array_push($quantities,$quant_arry);
          
    //     }

       


    //     $this->merge([
    //         'quantity'=>$quantities

    //     ]);

    //     // dd($this->quantity);
        
      
      
    // }

    public function messages()
    {
        return [
            'color.*.required' => "please enter at least one color",
            'size.*.*.required' =>"please enter at least one size",
            'images.*.*.required' =>"please enter at least 5 images",
        ];

    }
}
