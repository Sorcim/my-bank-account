<?php

namespace App\Application\Presenters;

use App\Application\Services\PaginationService;
use App\Domain\Entities\PaginatedTransactions;

class PaginatedTransactionsPresenter {
    public array $transactions;
    public int $currentPage;
    public int $lastPage;
    public int $perPage;
    public int $total;
    public array $paginationNumbers;

    public function __construct(PaginatedTransactions $paginatedTransactions)
    {
        $this->transactions = $this->groupByMonth($paginatedTransactions->transactions);

        $this->currentPage = $paginatedTransactions->currentPage;
        $this->lastPage = $paginatedTransactions->lastPage;
        $this->perPage = $paginatedTransactions->perPage;
        $this->total = $paginatedTransactions->total;
        $this->paginationNumbers = PaginationService::generatePaginationNumbers($paginatedTransactions->currentPage, $paginatedTransactions->lastPage);
    }


    private function groupByMonth(array $paginatedTransactions): array
    {
        $grouped = [];

        foreach ($paginatedTransactions as $transaction) {
            $key = $transaction->effectiveAt->format('m-Y');

            if (!isset($grouped[$key])) {
                $grouped[$key] = [];
            }

            // Ajouter la transaction au groupe correspondant
            $grouped[$key][] = [
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'effective_at' => $transaction->effectiveAt,
                'description' => $transaction->description,
                'checked' => $transaction->checked,
                'category' => $transaction->category,
            ];
        }

        return $grouped;
    }
}
