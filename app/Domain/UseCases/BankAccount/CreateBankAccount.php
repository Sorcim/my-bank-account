<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\Entities\BankAccount;
use App\Domain\Repositories\BankAccountRepository;

class CreateBankAccount
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(BankAccount $bankAccount): bool
    {
        return $this->bankAccountRepository->create( $bankAccount );
    }
}
