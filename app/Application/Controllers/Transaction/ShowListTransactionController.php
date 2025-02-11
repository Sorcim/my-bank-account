<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Presenters\PaginatedTransactionsPresenter;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\UseCases\Transaction\ShowPaginatedTransactionsUseCase;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowListTransactionController
{
    public function __construct(
        private ShowPaginatedTransactionsUseCase $showPaginatedTransactionsUseCase,
        private CategoryRepository $categoryRepository)
    {}

    public function render(Request $request, string $bankAccountId)
    {
        $page = $request->query('page', 1);
        $transactions = $this->showPaginatedTransactionsUseCase->execute($bankAccountId, 10, $page);
        $categories = $this->categoryRepository->all(auth()->id());
        $presentedTransactions = new PaginatedTransactionsPresenter($transactions);
        return Inertia::render('Transactions/ListTransaction', [
            'paginatedTransactions' => $presentedTransactions,
            'bankAccountId' => $bankAccountId,
            'categories' => $categories,
        ]);
    }
}
