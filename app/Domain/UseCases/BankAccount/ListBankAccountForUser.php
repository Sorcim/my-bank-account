<?php

namespace App\Domain\UseCases\BankAccount;

use App\Domain\Entities\PaginatedBankAccountSummary;
use App\Domain\Repositories\BankAccountRepository;

class ListBankAccountForUser
{

    public function __construct(private readonly BankAccountRepository $bankAccountRepository)
    {}

    public function execute(string $userId, int $page = 1, int $perPage = 12): PaginatedBankAccountSummary
    {
        return $this->bankAccountRepository->findAllByUser($userId, $page, $perPage);
    }
}
