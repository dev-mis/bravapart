<?php

declare(strict_types=1);

namespace App\Request\Backend\Settings\Users;

use Hyperf\Validation\Request\FormRequest;

class EditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone Number',
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
