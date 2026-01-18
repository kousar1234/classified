<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:250',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => translate('Tag title is required'),
        ];
    }
}
