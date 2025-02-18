<?php

namespace App\Application\Controllers\RecurringTransaction;

use App\Domain\UseCases\RecurringTransaction\DeleteRecurringTransactionUseCase;
use Illuminate\Http\RedirectResponse;

class DeleteRecurringTransactionController
{
    public function __construct(private DeleteRecurringTransactionUseCase $deleteRecurringTransactionUseCase) {}

    public function execute(string $id): RedirectResponse
    {
        $transaction = $this->deleteRecurringTransactionUseCase->getRecurringTransaction($id);
        $this->deleteRecurringTransactionUseCase->execute($transaction);

        return back()->with('success', 'Transaction deleted successfully');
    }
}
