<?php

namespace App\Application\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionFromImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'bank_account_id' => 'required|exists:bank_accounts,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
