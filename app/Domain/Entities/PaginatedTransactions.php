<?php

namespace App\Domain\Entities;

class PaginatedTransactions {
    /** @var Transaction[] */
    public array $transactions;
    public int $currentPage;
    public int $lastPage;
    public int $perPage;
    public int $total;

    public function __construct(array $transactions, int $currentPage, int $lastPage, int $perPage, int $total)
    {
        $this->transactions = $transactions;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->perPage = $perPage;
        $this->total = $total;
    }
}
