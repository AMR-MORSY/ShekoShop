<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class SearchProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user()->hasRole('admin'))
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
            //
        ];
    }
}
