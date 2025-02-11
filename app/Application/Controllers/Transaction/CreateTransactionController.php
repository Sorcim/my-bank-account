<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Requests\Transaction\CreateTransactionRequest;
use App\Domain\Factories\TransactionFactory;
use App\Domain\UseCases\Transaction\CreateTransactionUseCase;

class CreateTransactionController
{
    public function __construct(private CreateTransactionUseCase $createTransaction)
    {
    }

    public function execute(CreateTransactionRequest $request)
    {
        $request->validated();
        $transaction = TransactionFactory::fromArray($request->all());
        $this->createTransaction->execute($transaction);
        return back();
    }
}
