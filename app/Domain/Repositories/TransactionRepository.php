<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\PaginatedTransactions;
use App\Domain\Entities\Transaction;

interface TransactionRepository
{
    public function get(string $transactionId): Transaction;

    public function getListTransactionsForBankAccount(string $bankAccountId, ?int $limit): array;

    public function findPaginatedByBankAccountId(string $bankAccountId, int $perPage, int $page): PaginatedTransactions;

    public function create(Transaction $transaction): bool;

    public function delete(Transaction $transaction): bool;

    public function update(Transaction $transaction): bool;
}
