<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Presenters\PaginatedBankAccountSummaryPresenter;
use App\Domain\UseCases\BankAccount\ListBankAccountForUser;
use Inertia\Inertia;

class ListBankAccountController
{
    public function __construct(private ListBankAccountForUser $listBankAccountForUser)
    {
    }

    public function render()
    {
        $paginatedBankAccounts = $this->listBankAccountForUser->execute(auth()->id());
        return Inertia::render('Home', [
            'paginatedBankAccounts' => new PaginatedBankAccountSummaryPresenter($paginatedBankAccounts),
        ]);
    }
}
