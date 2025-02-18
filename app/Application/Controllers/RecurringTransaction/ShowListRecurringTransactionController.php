<?php

namespace App\Application\Controllers\RecurringTransaction;

use App\Application\Presenters\PaginatedRecurringTransactionsPresenter;
use App\Domain\UseCases\BankAccount\GetListBankAccountForUserUseCase;
use App\Domain\UseCases\Category\GetListCategoryUseCase;
use App\Domain\UseCases\RecurringTransaction\GetRecurringTransactionUseCase;
use Inertia\Inertia;

class ShowListRecurringTransactionController
{
    public function __construct(
        private GetRecurringTransactionUseCase $getRecurringTransactionUseCase,
        private GetListCategoryUseCase $getListCategoryUseCase,
        private GetListBankAccountForUserUseCase $getListBankAccountForUserUseCase,
    ) {}

    public function render(int $page = 1, int $perPage = 15)
    {
        $recurringTransactions = $this->getRecurringTransactionUseCase->execute(auth()->id(), $page, $perPage);
        $categories = $this->getListCategoryUseCase->execute(auth()->id());
        $bankAccounts = $this->getListBankAccountForUserUseCase->execute(auth()->id());

        return Inertia::render('RecurringTransaction/ListRecurringTransaction', [
            'recurringTransactions' => new PaginatedRecurringTransactionsPresenter($recurringTransactions),
            'categories' => $categories,
            'bankAccounts' => $bankAccounts,
        ]);
    }
}
