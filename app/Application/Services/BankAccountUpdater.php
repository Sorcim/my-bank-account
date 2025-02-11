<?php

namespace App\Application\Services;

use App\Domain\Entities\BankAccount;

class BankAccountUpdater {
    public function update(BankAccount $bankAccount, array $data): BankAccount
    {
        if(isset($data['start_balance'])){
            $bankAccount->startBalance = $data['start_balance'];
        }
        if(isset($data['name'])){
            $bankAccount->name = $data['name'];
        }

        return $bankAccount;
    }
}
