<?php

namespace App\Application\Presenters;

use App\Application\Services\PaginationService;
use App\Domain\Entities\PaginatedRecurringTransactions;

class PaginatedRecurringTransactionsPresenter
{
    public array $transactions;

    public int $currentPage;

    public int $lastPage;

    public int $perPage;

    public int $total;

    public array $paginationNumbers;

    public function __construct(PaginatedRecurringTransactions $paginatedTransactions)
    {
        $this->transactions = $paginatedTransactions->transactions;
        $this->currentPage = $paginatedTransactions->currentPage;
        $this->lastPage = $paginatedTransactions->lastPage;
        $this->perPage = $paginatedTransactions->perPage;
        $this->total = $paginatedTransactions->total;
        $this->paginationNumbers = PaginationService::generatePaginationNumbers($paginatedTransactions->currentPage, $paginatedTransactions->lastPage);
    }
}
