<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$this->user->id,
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'role' => 'required|integer',
            'status' => 'nullable|integer',
            'image' => 'nullable|image|size:1024|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100,max_width=500,max_height=500'
        ];
    }
}
