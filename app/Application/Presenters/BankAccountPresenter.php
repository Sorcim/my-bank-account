<?php

namespace App\Application\Presenters;

use App\Domain\Entities\BankAccount;

class BankAccountPresenter
{

    public array $bankAccounts = [];

    /**
     * @param array $bankAccounts
     */
    public function __construct(array $bankAccounts)
    {
        $this->bankAccounts = $bankAccounts;
    }


    public function toHomeResponse()
    {
        return array_map(fn($bankAccount) => self::presentBankAccount($bankAccount), $this->bankAccounts);
    }

    private function presentBankAccount(BankAccount $bankAccount): array
    {
        $mostRecentTransaction = $bankAccount->getMostRecentTransaction();

        return [
            'id' => $bankAccount->id,
            'name' => $bankAccount->name,
            'start_balance' => $bankAccount->startBalance/100,
            'current_balance' => $bankAccount->getRemainingBalance() / 100,
            'latest_transaction' => $mostRecentTransaction
                ? [
                    'description' => $mostRecentTransaction->description,
                    'amount' => $mostRecentTransaction->amount / 100,
                    'effective_at' => $mostRecentTransaction->effectiveAt->format('d-m-Y'),
                ]
                : null,
        ];
    }
}
