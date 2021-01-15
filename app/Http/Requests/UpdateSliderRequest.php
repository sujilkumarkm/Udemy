<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:sliders|min:10', 
            'description' => 'required|unique:sliders|min:20', 
            'image' => 'required|mimes:jpg,jpeg,png',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Please input Slider Title',
        ];
    }
}
