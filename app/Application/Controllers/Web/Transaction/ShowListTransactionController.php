<?php

namespace App\Application\Controllers\Web\Transaction;

use App\Application\Presenters\PaginatedTransactionsPresenter;
use App\Domain\UseCases\Category\GetListCategoryUseCase;
use App\Domain\UseCases\Transaction\ShowPaginatedTransactionsUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowListTransactionController
{
    public function __construct(
        private ShowPaginatedTransactionsUseCase $showPaginatedTransactionsUseCase,
        private GetListCategoryUseCase $getListCategoryUseCase,
    ) {}

    public function render(Request $request, string $bankAccountId)
    {
        $page = $request->query('page', 1);
        $transactions = $this->showPaginatedTransactionsUseCase->execute($bankAccountId, 10, $page);
        $categories = $this->getListCategoryUseCase->execute(auth()->id());
        $presentedTransactions = new PaginatedTransactionsPresenter($transactions);

        return Inertia::render('Transactions/ListTransaction', [
            'paginatedTransactions' => $presentedTransactions,
            'bankAccountId' => $bankAccountId,
            'categories' => $categories,
        ]);
    }
}
