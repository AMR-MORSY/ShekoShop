<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;

class submitOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth()->user())
        {
            return true;
        }
        else
        {
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

            "shipping_method"=>['regex:/^pickup|delivery$/',"required"],
            "state_id"=>'required|exists:states,id', 
           "payment_method"=>['required','regex:/^cash_on_delivery$/'], 
            "user_id"=>'required|exists:users,id', 
            "products"=>'required|array',
            "subtotal"=>['required','regex:/^[0-9]{1,8}[.][0-9]{1,2}$/'],
            "total_price"=>['required','regex:/^[0-9]{1,8}[.][0-9]{1,2}$/']
        ];
    }
}
