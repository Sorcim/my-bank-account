<?php

namespace App\Application\Controllers\Web\Transaction;

use App\Application\Requests\Transaction\EditTransactionRequest;
use App\Application\Services\TransactionUpdater;
use App\Domain\UseCases\Transaction\EditTransactionUseCase;

class EditTransactionController
{
    public function __construct(private EditTransactionUseCase $editTransactionUseCase, private TransactionUpdater $transactionUpdater) {}

    public function execute(EditTransactionRequest $request, string $transactionId)
    {
        $request->validated();
        $transaction = $this->editTransactionUseCase->getTransaction($transactionId);
        if (! $transaction) {
            throw new \Exception('Transaction not found');
        }
        $transaction = $this->transactionUpdater->update($transaction, $request->all());
        $this->editTransactionUseCase->execute($transaction);
    }
}
