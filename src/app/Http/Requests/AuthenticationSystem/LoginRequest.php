<?php

namespace Lexontech\AuthenticationSystem\app\Http\Requests\AuthenticationSystem;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'PhoneNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11'
        ];
    }
}
