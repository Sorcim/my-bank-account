<?php

namespace App\Domain\UseCases\RecurringTransaction;

use App\Domain\Entities\PaginatedRecurringTransactions;
use App\Domain\Repositories\RecurringTransactionRepository;

class GetRecurringTransactionUseCase
{
    public function __construct(private RecurringTransactionRepository $recurringTransactionRepository) {}

    public function execute(string $userId, int $page = 1, int $perPage = 15): PaginatedRecurringTransactions
    {
        return $this->recurringTransactionRepository->getByUserId($userId, $page, $perPage);
    }
}
