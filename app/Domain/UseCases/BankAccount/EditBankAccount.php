<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\Entities\BankAccount;
use App\Domain\Repositories\BankAccountRepository;

class EditBankAccount
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(BankAccount $bankAccount): bool
    {
        return $this->bankAccountRepository->update($bankAccount);
    }

    public function getBankAccountById(string $id): ?BankAccount
    {
        return $this->bankAccountRepository->get($id);
    }
}
