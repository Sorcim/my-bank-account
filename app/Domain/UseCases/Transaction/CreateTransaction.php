<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\DTOs\CreateTransactionDTO;
use App\Domain\Repositories\TransactionRepository;

class CreateTransaction
{


    public function __construct(private TransactionRepository $transactionRepository)
    {
    }

    public function execute(CreateTransactionDTO $createTransactionDTO)
    {
        return $this->transactionRepository->create($createTransactionDTO);
    }
}
