<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAddress extends FormRequest
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
        if ($this->has('different_address')) {
            return [
                'address.*.first_name' => 'required',
                'address.*.last_name' => 'required',
                'address.*.phone_number' => 'required',
                'address.*.address_name' => 'required',
                // 'address.*.country' => 'required',
                'address.*.email' => 'required|email',
            ];
        } else {
            return [
                'address.billing.first_name' => 'required',
                'address.billing.last_name' => 'required',
                'address.billing.phone_number' => 'required',
                'address.billing.address_name' => 'required',
                // 'address.billing.country' => 'required',
                'address.billing.email' => 'required|email',
            ];
        }
    }
    public function messages()
    {
        return [
            'address.*.first_name' => 'The First Name Is Required',
            'address.*.last_name' => 'The Last Name Is Required',
            'address.*.phone_number' => 'The Phone Is Required',
            'address.*.address_name' => 'The Address Is Required',
            // 'address.*.country' => 'The Country Is Required',
            'address.*.email.required' => 'The Email Is Required',
            'address.*.email.email' => 'The Email Is Invalid',
        ];
    }
}
