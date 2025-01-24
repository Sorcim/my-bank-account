<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Requests\Transaction\CreateTransactionRequest;
use App\Domain\DTOs\CreateTransactionDTO;
use App\Domain\UseCases\Transaction\CreateTransaction;

class CreateTransactionController
{
    public function __construct(private CreateTransaction $createTransaction)
    {
    }

    public function execute(CreateTransactionRequest $request)
    {
        $payload = $request->validated();
        $createTransactionDTO = new CreateTransactionDTO($payload['description'], $payload['amount'], $payload['effective_at'], $payload['bank_account_id'], null);
        $this->createTransaction->execute($createTransactionDTO);
        return back();
    }
}
