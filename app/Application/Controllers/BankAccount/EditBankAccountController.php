<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Requests\BankAccount\EditBankAccountRequest;
use App\Application\Services\BankAccountUpdater;
use App\Domain\UseCases\BankAccount\EditBankAccount;

class EditBankAccountController
{

    public function __construct(private EditBankAccount $editBankAccount, private BankAccountUpdater $bankAccountUpdater)
    {
    }

    public function execute(string $id, EditBankAccountRequest $request)
    {
        $request->validated();
        $bankAccount = $this->editBankAccount->getBankAccountById($id);
        if (!$bankAccount) {
            throw new \Exception("Bank account not found");
        }
        $this->editBankAccount->execute($this->bankAccountUpdater->update($bankAccount, $request->all()));
        return back();
    }
}
