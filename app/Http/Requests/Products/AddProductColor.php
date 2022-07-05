<?php

namespace App\Http\Requests\Products;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Http\FormRequest;

class AddProductColor extends FormRequest
{
    use HasRoles;
    protected $errorBag = 'add_color';
    protected $errors;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $id=Auth::user()->id;
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
            'product_id' => 'required|exists:products,id',
            'color' => 'exists:colors,id',
            'size' => 'required|exists:sizes,id',

            'images.*.*' => 'mimes:jpg,bmp,png',

        ];
    }

    public function messages()
    {
        return [
            'color.exists:colors,id' => 'please upload color',
            'images.required' => 'please upload images',
            'images.*.*.mimes:jpg,bmp,png' => 'only jpg,bmp,png',
        ];
    }
}
