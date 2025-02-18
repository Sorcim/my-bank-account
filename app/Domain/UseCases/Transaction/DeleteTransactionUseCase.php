<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Entities\Transaction;
use App\Domain\Repositories\TransactionRepository;

class DeleteTransactionUseCase
{
    public function __construct(
        private TransactionRepository $transactionRepository
    ) {}

    public function execute(Transaction $transaction): bool
    {
        return $this->transactionRepository->delete($transaction);
    }

    public function getTransaction(string $transactionId): Transaction
    {
        return $this->transactionRepository->get($transactionId);
    }
}
