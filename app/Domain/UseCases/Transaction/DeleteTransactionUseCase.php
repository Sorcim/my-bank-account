<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Repositories\TransactionRepository;

class DeleteTransactionUseCase
{
    public function __construct(
        private TransactionRepository $transactionRepository
    ) {
    }

    public function execute(string $transactionId): bool
    {
        return $this->transactionRepository->delete($transactionId);
    }

}
