<?php

namespace App\Application\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class EditTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'string',
            'amount' => 'numeric',
            'effective_at' => 'date',
            'checked' => 'boolean',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
