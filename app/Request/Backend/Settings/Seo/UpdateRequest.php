<?php

declare(strict_types=1);

namespace App\Request\Backend\Settings\Seo;

use Hyperf\Validation\Request\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    public function messages (): array
    {
        return [
            'required' => ':attribute is required',
        ];
    }
}
