<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|max:200',
            'password' => 'required|min:6|max:200'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => translation('Email or Phone is required'),
            'password.required' => translation('Password is required'),
            'password.min' => translation('Password is too short'),
        ];
    }
}
