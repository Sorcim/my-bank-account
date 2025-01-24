<?php

namespace App\Application\Controllers\BankAccount;

use App\Domain\UseCases\BankAccount\DeleteBankAccount;

class DeleteBankAccountController
{
    public function __construct(private DeleteBankAccount $deleteBankAccount)
    {
    }
    public function execute(string $id)
    {
        $this->deleteBankAccount->execute($id);
        return back();
    }
}
