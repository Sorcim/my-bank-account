<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\Repositories\BankAccountRepository;

class DeleteBankAccount
{
    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(string $id): bool
    {
        return $this->bankAccountRepository->delete( $id );
    }
}
