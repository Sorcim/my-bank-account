<?php

namespace App\Application\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'color' => 'string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
