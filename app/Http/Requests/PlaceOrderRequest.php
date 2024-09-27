<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([

            'payment_method_id'=>$this->payment,
            'state_id' =>$this->state['id'],
            'email'=>$this->user_email,
            'mobile'=>intval($this->mobile),
            'total_order_price'=>$this->order_price
           
        ]);
        if(auth()->user())
        {
            $this->merge(['user_id'=>auth()->user()->id]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'state_id' => ['required', 'exists:states,id'],
            'shipping_address' => ['required', 'string'],
            'shipping_rate' => ['nullable', 'decimal:0,1000'],
            'billing_address' => ['nullable', 'string', 'max:2000'],
            'email' => ['required', 'email'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'mobile' => ['required', 'integer', 'max_digits:15'],
            'total_order_price' => ['required', 'decimal:0'],
            'notes' => ['nullable', 'string', 'max:5000'],
            'cart_products'=>['required','array'],
            "cart_products.*.product.id"=>['exists:products,id'],
            "cart_products.*.quantity"=>['required','integer','min:1'],
            'cart_products.*.size_price'=>["required", 'decimal:0'],
            'cart_products.*.size.id'=>['exists:sizes,id'],
            "cart_products.*.options"=>['array'],
            "cart_products.*.options.id*"=>['nullable','exists:options,id'],
            "cart_products.*.extra_quantity_prices"=>['required','decimal:0'],
            "cart_products.*.product_final_price"=>['required','decimal:0']

        ];
    }
}
