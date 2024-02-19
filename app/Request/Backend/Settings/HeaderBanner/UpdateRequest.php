<?php

declare(strict_types=1);

namespace App\Request\Backend\Settings\HeaderBanner;

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
            // 'image' => 'file',
            // 'image_mobile' => 'file',
            'title' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'image' => 'Background',
            'image_mobile' => 'Background Mobile',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    public function messages (): array
    {
        return [
            'required' => ':attribute is required',
            'file' => ':attribute must be file!'
        ];
    }
}
