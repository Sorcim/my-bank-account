<?php

namespace App\Application\Controllers\RecurringTransaction;

use App\Application\Requests\RecurringTransaction\CreateRecurringTransactionRequest;
use App\Domain\Factories\RecurringTransactionFactory;
use App\Domain\UseCases\RecurringTransaction\CreateRecurringTransactionUseCase;

class CreateRecurringTransactionController
{
    public function __construct(private CreateRecurringTransactionUseCase $createRecurringTransactionUseCase) {}

    public function execute(CreateRecurringTransactionRequest $request)
    {
        $request->validated();

        $recurringTransaction = RecurringTransactionFactory::fromArray($request->all());
        $this->createRecurringTransactionUseCase->execute($recurringTransaction);
    }
}
