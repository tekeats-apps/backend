<?php

namespace App\Http\Requests\Admin;

use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrder extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required',
            'store_name' => ['required', function ($attribute, $value, $fail) {
                    $value = Str::slug($value);
                    if (Tenant::where('id', $value)->exists()) {
                        $fail('The name is already in use.');
                    }
                },
            ],
            'email' => 'required|email',
            'login_password' => 'required|min:6',
            'domain' => 'required',
            'payment_status' => 'required|in:paid,unpaid,failed',
            'status' => 'required|in:active,pending,expired,rejected'
        ];
    }
}
