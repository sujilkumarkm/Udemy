<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brands|min:4', 
            'brand_image' => 'required|mimes:jpg,jpeg,png', 
        ];
    }
    
    public function messages()
    {
       return [
            'brand_name.required' => 'Please input brand name',
            'brand_image.min' => 'Brand Longer than 4 Charectors',
        ];
    }
}
