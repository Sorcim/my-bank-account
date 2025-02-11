<?php

namespace App\Application\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'effective_at' => 'required|date',
            'category_id' => 'exists:categories,id|nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
