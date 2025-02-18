<?php

namespace App\Application\Requests\RecurringTransaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecurringTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'frequency' => 'required|string|in:monthly,yearly,weekly,daily',
            'category_id' => 'exists:categories,id|nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
