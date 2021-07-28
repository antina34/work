<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string',
            'email'                 => 'required|email',
            'password_confirmation' => 'required_with:password',
            'password'              => 'required_with:password_confirmation',
            'telephone'              => ['required', 'regex:/^\+?\d{3} ?\d{3} ?\d{3} ?\d{3}$/']
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please insert your full name',
            'password_confirmation.required_with' => 'Please confirm the password',
            'password.required_with' => 'Password field is required',
        ];
    }
}
