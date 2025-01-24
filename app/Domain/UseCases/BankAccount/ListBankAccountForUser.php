<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\Repositories\BankAccountRepository;

class ListBankAccountForUser
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(string $userId): array
    {
        return $this->bankAccountRepository->findAllByUser($userId);
    }
}
