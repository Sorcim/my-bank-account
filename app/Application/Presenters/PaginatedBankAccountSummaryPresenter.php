<?php

namespace App\Application\Presenters;

use App\Application\Services\PaginationService;
use App\Domain\Entities\PaginatedBankAccountSummary;

class PaginatedBankAccountSummaryPresenter
{

    public array $bankAccounts;
    public int $currentPage;
    public int $lastPage;
    public int $perPage;
    public int $total;
    public array $paginationNumbers;


    public function __construct(PaginatedBankAccountSummary $paginatedBankAccountSummary)
    {
        $this->bankAccounts = $paginatedBankAccountSummary->bankAccounts;
        $this->total = $paginatedBankAccountSummary->total;
        $this->perPage = $paginatedBankAccountSummary->perPage;
        $this->currentPage = $paginatedBankAccountSummary->currentPage;
        $this->lastPage = $paginatedBankAccountSummary->lastPage;
        $this->paginationNumbers = PaginationService::generatePaginationNumbers($paginatedBankAccountSummary->currentPage, $this->lastPage);
    }
}
