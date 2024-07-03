<?php

namespace App\Http\Requests\Vendor\Customers\API;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first_name field is required.',
            'first_name.string' => 'The first_name field must be of type string.',
            'first_name.max' => 'The first_name must not be more than 255 characters.',

            'last_name.required' => 'The last_name field is required.',
            'last_name.string' => 'The last_name field must be of type string.',
            'last_name.max' => 'The last_name must not be more than 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The provided email is already in use.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be of type string.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
