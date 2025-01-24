<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\CreateTransactionDTO;
use App\Domain\DTOs\EditTransactionDto;

interface TransactionRepository
{
    public function getListTransactionsForBankAccount(string $bankAccountId): array;

    public function create(CreateTransactionDto $createTransactionDto): bool;

    public function delete(string $transactionId): bool;

    public function update(string $transactionId, EditTransactionDto $editTransactionDto): bool;
}
