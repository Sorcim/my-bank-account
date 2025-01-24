<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Presenters\ListTransactionPresenter;
use App\Domain\UseCases\Transaction\ShowListTransaction;
use Inertia\Inertia;

class ShowListTransactionController
{
    public function __construct(private ShowListTransaction $showListTransaction)
    {
    }

    public function render(string $bankAccountId)
    {
        $transactions = $this->showListTransaction->execute($bankAccountId);
        $presentedTransactions = new ListTransactionPresenter($transactions);
        return Inertia::render('Transactions/ListTransaction', [
            'transactions' => $presentedTransactions->toInertia(),
            'bankAccountId' => $bankAccountId,
        ]);
    }
}
