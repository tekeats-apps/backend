<?php

namespace App\Http\Requests\Admin\Api\Tenants;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTenantRequest extends FormRequest
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
            'customer_name' => 'required',
            'business_name' => 'required',
            'domain' => 'required',
            'email' => 'required|email',
        ];
    }
}
