<?php

namespace App\Application\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
