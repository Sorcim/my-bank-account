<?php

namespace App\Domain\Entities;

class PaginatedBankAccountSummary {
    /** @var BankAccountSummary[] */
    public array $bankAccounts;
    public int $currentPage;
    public int $lastPage;
    public int $perPage;
    public int $total;

    public function __construct(array $bankAccounts, int $currentPage, int $lastPage, int $perPage, int $total)
    {
        $this->bankAccounts = $bankAccounts;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->perPage = $perPage;
        $this->total = $total;
    }
}
