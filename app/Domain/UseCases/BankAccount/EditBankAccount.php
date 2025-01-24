<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\DTOs\CreateBankAccountDTO;
use App\Domain\DTOs\EditBankAccountDTO;
use App\Domain\Repositories\BankAccountRepository;

class EditBankAccount
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(string $id, EditBankAccountDTO $payload): bool
    {
        return $this->bankAccountRepository->update($id, $payload);
    }
}
