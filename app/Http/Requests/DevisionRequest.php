<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class DevisionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
     {
        $this->merge([
            "slug"=>Str::slug($this->devision_name,'-')

        ]);
     }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "devision_name" => ["required", "string", "max:50",Rule::unique("devisions")->ignore($this->devision)],
           "description" => ["required", "string", "max:300"],
            "slug" => ["required", "string", "max:50", Rule::unique("devisions")->ignore($this->devision)],
          
            "images" => [Rule::requiredIf(function () {
                return $this->routeIs("devision.store");
           }), "nullable","array"],
            "images.*"=>[File::image()->max(12*1024)]

        ];
    }
}
