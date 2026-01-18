<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:250',
            'permalink' => 'required|unique:tl_ads_categories,permalink,' . request()->id,
        ];
    }

    public function messages()
    {

        return [
            'title.required' => translate('Title is required'),
            'permalink.required' => translate('Permalink is required'),
            'permalink.unique' => translate('Permalink is already exists'),
            'parent.exists' => translate('Selected parent does not exists'),

        ];
    }
}
