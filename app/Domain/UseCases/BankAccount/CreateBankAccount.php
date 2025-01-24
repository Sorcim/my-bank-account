<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\DTOs\CreateBankAccountDTO;
use App\Domain\Repositories\BankAccountRepository;

class CreateBankAccount
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(CreateBankAccountDTO $payload): bool
    {
        return $this->bankAccountRepository->create( $payload );
    }
}
