<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
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
            'name' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user')?->id ,

            'phone' => 'required|string|min:11|max:11|unique:users,phone,' . $this->route('user')?->id,

            'password' => $this->isMethod('post')
                ? 'required|string|min:8'
                : 'nullable|string|min:8',

            'user_type' => 'required|in:admin,user',
        ];

    }
}
