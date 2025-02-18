<?php

namespace App\Domain\UseCases\RecurringTransaction;

use App\Domain\Entities\RecurringTransaction;
use App\Domain\Repositories\RecurringTransactionRepository;

class EditRecurringTransactionUseCase
{
    public function __construct(private RecurringTransactionRepository $recurringTransactionRepository) {}

    public function execute(RecurringTransaction $recurringTransaction): bool
    {
        return $this->recurringTransactionRepository->update($recurringTransaction);
    }

    public function get(string $id): RecurringTransaction
    {
        return $this->recurringTransactionRepository->get($id);
    }
}
