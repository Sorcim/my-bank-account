<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Presenters\BankAccountPresenter;
use App\Domain\UseCases\BankAccount\ListBankAccountForUser;
use Inertia\Inertia;

class ListBankAccountController
{
    public function __construct(private ListBankAccountForUser $listBankAccountForUser)
    {
    }

    public function render()
    {
        $bankAccounts = $this->listBankAccountForUser->execute(auth()->id());
        $presenter = new BankAccountPresenter($bankAccounts);

        return Inertia::render('Home', [
            'bankAccounts' => $presenter->toHomeResponse()
        ]);
    }
}
