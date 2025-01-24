<?php

namespace App\Application\Requests\BankAccount;

use App\Infrastructure\Persistence\BankAccountModel;
use Illuminate\Foundation\Http\FormRequest;

class EditBankAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        $bankAccount = BankAccountModel::findOrFail($this->route('id'));

        return $this->user()->can('update', $bankAccount);
    }

    public function rules(): array
    {
        return [
            'name' => 'string',
            'start_balance' => 'numeric|min:0',
        ];
    }
}
