<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string','in:Monthly,Yearly'],
            'price' => ['required', 'numeric', 'between:0,999999999.99'],
            'discount' => ['nullable', 'numeric', 'between:0,999999999.99'],
            'trial_period_days' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:20000']
        ];
    }
}
