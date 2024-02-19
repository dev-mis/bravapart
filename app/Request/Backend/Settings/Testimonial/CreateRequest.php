<?php

declare(strict_types=1);

namespace App\Request\Backend\Settings\Testimonial;

use Hyperf\Validation\Request\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'required',
            'name' => 'required',
            'occupation' => 'required',
            'review' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'image' => 'Image',
            'name' => 'Name',
            'occupation ' => 'Occupation',
            'review' => 'Review',
        ];
    }

    public function messages (): array
    {
        return [
            'required' => ':attribute is required',
        ];
    }
}
