<?php

namespace App\Http\Requests\Products;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateColorSize extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $errorBag = 'update_color_size';
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
            'color'=>'required|exists:product_size,color_id',
            'product'=>'required|exists:product_size,product_id',
            'size'=>'required|exists:sizes,id'
        ];
    }
}
