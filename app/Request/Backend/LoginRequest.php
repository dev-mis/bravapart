<?php

declare(strict_types=1);

namespace App\Request\Backend;

use Hyperf\Validation\Request\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public function messages (): array
    {
        return [
            'required' => ':attribute is required',
            'email' => ':attribute format is must be a valid email address'
        ];
    }
}
