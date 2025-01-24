<?php

namespace App\Application\Requests\BankAccount;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'start_balance' => 'required|numeric',
        ];
    }
}
