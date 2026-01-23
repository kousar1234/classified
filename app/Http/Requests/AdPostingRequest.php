<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdPostingRequest extends FormRequest
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
            'city' => 'required|max:10',
            'category' => 'required|max:10',
            'old_thumbnail_id' => 'nullable',
            'thumbnail_image' => 'required_if:old_thumbnail_id,null',
            'contact_email' => 'required|email|max:200',
            'contact_phone' => 'required|max:100',
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
