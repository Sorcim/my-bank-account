<?php

namespace App\Application\Controllers\Transaction;

use App\Domain\UseCases\Transaction\DeleteTransactionUseCase;
use Illuminate\Http\RedirectResponse;

class DeleteTransactionController
{

    public function __construct(private DeleteTransactionUseCase $deleteTransactionUseCase)
    {
    }

    public function execute(string $transactionId): RedirectResponse
    {
        $transaction = $this->deleteTransactionUseCase->getTransaction($transactionId);
        $this->deleteTransactionUseCase->execute($transaction);

        return back()->with('success', 'Transaction deleted successfully');
    }
}
