<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\PaginatedRecurringTransactions;
use App\Domain\Entities\RecurringTransaction;

interface RecurringTransactionRepository
{
    public function getByUserId(string $userId, int $page, int $perPage): PaginatedRecurringTransactions;

    public function create(RecurringTransaction $recurringTransaction): bool;

    public function update(RecurringTransaction $recurringTransaction): bool;

    public function delete(RecurringTransaction $recurringTransaction): bool;

    public function get(string $id): RecurringTransaction;
}
