<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Requests\BankAccount\EditBankAccountRequest;
use App\Domain\DTOs\EditBankAccountDTO;
use App\Domain\UseCases\BankAccount\EditBankAccount;

class EditBankAccountController
{

    public function __construct(private EditBankAccount $editBankAccount)
    {
    }

    public function execute(string $id, EditBankAccountRequest $request)
    {
        $payload = $request->validated();
        $editBankAccountDTO = new EditBankAccountDTO($payload['name'], $payload['start_balance']);
        $this->editBankAccount->execute($id, $editBankAccountDTO);
        return back();
    }
}
