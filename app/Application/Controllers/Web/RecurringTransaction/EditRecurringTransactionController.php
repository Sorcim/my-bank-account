<?php

namespace App\Application\Controllers\Web\RecurringTransaction;

use App\Application\Requests\RecurringTransaction\EditRecurringTransactionRequest;
use App\Application\Services\RecurringTransactionUpdater;
use App\Domain\UseCases\RecurringTransaction\EditRecurringTransactionUseCase;

class EditRecurringTransactionController
{
    public function __construct(private EditRecurringTransactionUseCase $editRecurringTransactionUseCase) {}

    public function execute(EditRecurringTransactionRequest $request)
    {
        $request->validated();
        $transaction = $this->editRecurringTransactionUseCase->get($request->id);
        if ($transaction === null) {
            throw new \Exception('Transaction not found');
        }
        $transaction = RecurringTransactionUpdater::update($transaction, $request->all());

        $this->editRecurringTransactionUseCase->execute($transaction);
    }
}
