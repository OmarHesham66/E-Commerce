<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRegister extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => "required|email",
            'password' => 'required|confirmed',
            'name' => 'required',
            // 'checkbox' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The Name Required !!',
            'email.required' => 'The Email Required !!',
            'password.required' => 'The Password Required !!',
            // 'email.unique' => 'The Email Invaild !!',
            'email.email' => 'The Email Invaild !!',
            // 'password.unique' => 'The Password Invaild !!',
            // 'checkbox.required' => 'You Must Agree terms & Policy For Registration !'
        ];
    }
}
