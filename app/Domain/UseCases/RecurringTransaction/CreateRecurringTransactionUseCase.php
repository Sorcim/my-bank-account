<?php

namespace App\Domain\UseCases\RecurringTransaction;

use App\Domain\Entities\RecurringTransaction;
use App\Domain\Repositories\RecurringTransactionRepository;

class CreateRecurringTransactionUseCase
{
    public function __construct(private RecurringTransactionRepository $repository) {}

    public function execute(RecurringTransaction $recurringTransaction): bool
    {
        return $this->repository->create($recurringTransaction);
    }
}
