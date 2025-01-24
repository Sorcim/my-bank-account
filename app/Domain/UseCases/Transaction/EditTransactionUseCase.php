<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\DTOs\EditTransactionDto;
use App\Domain\Repositories\TransactionRepository;

class EditTransactionUseCase
{

    public function __construct(private TransactionRepository $transactionRepository)
    {
    }

    public function execute(string $transactionId, EditTransactionDto $editTransactionDto)
    {
        return $this->transactionRepository->update($transactionId, $editTransactionDto);
    }
}
