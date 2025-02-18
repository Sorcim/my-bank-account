<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Presenters\PaginatedBankAccountSummaryPresenter;
use App\Domain\UseCases\BankAccount\GetPaginatedListBankAccountForUser;
use Inertia\Inertia;

class ListBankAccountController
{
    public function __construct(private GetPaginatedListBankAccountForUser $listBankAccountForUser) {}

    public function render()
    {
        $paginatedBankAccounts = $this->listBankAccountForUser->execute(auth()->id());

        return Inertia::render('Home', [
            'paginatedBankAccounts' => new PaginatedBankAccountSummaryPresenter($paginatedBankAccounts),
        ]);
    }
}
