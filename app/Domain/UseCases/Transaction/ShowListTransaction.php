<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Repositories\TransactionRepository;

class ShowListTransaction
{
    public function __construct(private readonly TransactionRepository $transactionRepository)
    {}

    public function execute(string $id): array
    {
        return $this->transactionRepository->getListTransactionsForBankAccount( $id );
    }
}
