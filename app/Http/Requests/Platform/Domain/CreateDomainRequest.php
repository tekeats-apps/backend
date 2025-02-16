<?php

namespace App\Http\Requests\Platform\Domain;

use Illuminate\Foundation\Http\FormRequest;

class CreateDomainRequest extends FormRequest
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
            'type' => 'required|in:subdomain,custom_domain',
            'domain' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $type = $this->input('type');
                    if ($type === 'subdomain' && !preg_match('/^[a-zA-Z0-9_-]+$/', $value)) {
                        $fail('The ' . $attribute . ' must be a valid subdomain (only letters, numbers, hyphens, and underscores).');
                    } elseif ($type === 'custom_domain' && !preg_match('/^[a-zA-Z0-9_-]+\.[a-zA-Z]+$/', $value)) {
                        $fail('The ' . $attribute . ' must be a valid custom domain (like "example.com").');
                    }
                },
            ],
        ];
    }
}
