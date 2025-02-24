<?php

namespace App\Domain\UseCases\RecurringTransaction;

use App\Domain\Entities\RecurringTransaction;
use App\Domain\Factories\TransactionFactory;
use App\Domain\Repositories\RecurringTransactionRepository;
use App\Domain\Repositories\TransactionRepository;

class ProcessRecurringTransactionUseCase
{
    public function __construct(private RecurringTransactionRepository $recurringTransactionRepository, private TransactionRepository $transactionRepository) {}

    public function execute(): void
    {
        $recurringTransactions = $this->recurringTransactionRepository->getRecurringTransactionToProcess();
        /** @var RecurringTransaction $recurringTransaction */
        foreach ($recurringTransactions as $recurringTransaction) {
            try {
                $transaction = TransactionFactory::fromRecurringTransaction($recurringTransaction);
                $this->transactionRepository->create($transaction);
                $recurringTransaction->markAsProcessed();
                $this->recurringTransactionRepository->update($recurringTransaction);
            } catch (\Exception $exception) {
                //todo: mettre en place un log / une alerte
                continue;
            }
        }
    }
}
