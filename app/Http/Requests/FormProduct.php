<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormProduct extends FormRequest
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
            'name' => 'required|max:150',
            'category_id' => 'required',
            'describtion' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photo' => 'required|image',
            'title' => 'string',
        ];
    }
}
