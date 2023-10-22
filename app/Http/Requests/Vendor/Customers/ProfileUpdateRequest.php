<?php

namespace App\Http\Requests\Vendor\Customers;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'first_name' => 'nullable|required|string|max:255',
            'last_name' => 'nullable|required|string|max:255',
            'phone_number' => 'nullable|required',
            'avatar' => 'nullable|image|max:1024|mimes:png,jpg', // allowing images up to 2MB
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other', // allowing only specific values for gender
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'phone_number.required' => 'The phone number field is required.',
            'avatar.image' => 'The avatar must be an image.',
            'avatar.max' => 'The avatar may not be greater than 1 MB.',
            'birthday.date' => 'The birthday must be a valid date.',
            'gender.in' => 'The selected gender is invalid.',
        ];
    }
}
