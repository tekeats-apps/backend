<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPlanRequest extends FormRequest
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
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'tag' => ['required', 'string', 'unique:plan_subscriptions,tag', 'max:255'],
                    'name' => ['required', 'string', 'unique:plan_subscriptions,name', 'max:255'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'invoice_interval' => ['required', 'in:year,month'],
                    'invoice_period' => ['required', 'numeric', 'min:0'],
                    'trial_interval' => ['required', 'in:day,month'],
                    'trial_period' => ['required', 'numeric', 'min:0'],
                    'grace_interval' => ['required', 'in:day,month'],
                    'grace_period' => ['required', 'numeric', 'min:0'],
                    'price' => ['required', 'numeric', 'between:0,999999999.99'],
                ];
            case 'PUT':
                return [
                    'tag' => ['required', 'string', 'unique:plan_subscriptions,tag,' . $this->id, 'max:255'],
                    'name' => ['required', 'string', 'unique:plan_subscriptions,name,' . $this->id, 'max:255'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'invoice_interval' => ['required', 'in:year,month'],
                    'invoice_period' => ['required', 'numeric', 'min:0'],
                    'trial_interval' => ['required', 'in:day,month'],
                    'trial_period' => ['required', 'numeric', 'min:0'],
                    'grace_interval' => ['required', 'in:day,month'],
                    'grace_period' => ['required', 'numeric', 'min:0'],
                    'price' => ['required', 'numeric', 'between:0,999999999.99'],
                ];
            default:
                return [];
        }
    }
}
