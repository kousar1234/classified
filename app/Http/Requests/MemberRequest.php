<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        if ($request->has('id') && $request['id'] != null) {
            return [
                'name' => 'required|max:250',
                'phone' => 'required|max:250|unique:Core\Models\User,phone,' . $request->id,
                'email' => 'required|max:250|email|unique:Core\Models\User,email,' . $request->id
            ];
        } else {
            return [
                'name' => 'required|max:250',
                'password' => 'required|confirmed|min:6|max:250',
                'phone' => 'required|max:250|unique:Core\Models\User,phone',
                'email' => 'required|max:250|email|unique:Core\Models\User,email'
            ];
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => translate('Name is required'),
            'password.required' => translate('Password is required'),
            'password.confirmed' => translate('Password does not match'),
            'password.min' => translate('Password is too short'),
            'phone.required' => translate('Phone is required'),
            'phone.unique' => translate('Phone is already used'),
            'email.required' => translate('Email is required'),
            'email.email' => translate('Incorrect email'),
            'email.unique' => translate('Email is already used'),
        ];
    }
}
