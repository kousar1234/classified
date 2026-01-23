<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAdUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'price' => 'required|max:200',
            'description' => 'required',
            'category' => 'required|max:10',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => translation('Title is required', session()->get('api_local')),
            'price.required' => translation('Price is required', session()->get('api_local')),
            'description.required' => translation('Description is required', session()->get('api_local')),
            'city.required' => translation('Please select a city', session()->get('api_local')),
            'category.required' => translation('Please select a category', session()->get('api_local')),
            'thumbnail_image.required' => translation('Thumbnail image is required', session()->get('api_local')),
            'contact_email.required' => translation('Email is required', session()->get('api_local')),
            'contact_phone.required' => translation('Phone is required', session()->get('api_local')),
        ];
    }
}
