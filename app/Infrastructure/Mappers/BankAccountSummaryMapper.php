<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\BankAccount;
use App\Domain\Entities\BankAccountSummary;
use App\Infrastructure\Persistence\BankAccountModel;

class BankAccountSummaryMapper {
    public static function toEntity(BankAccountModel $model): BankAccountSummary
    {
        return new BankAccountSummary(
            id: $model->id,
            name: $model->name,
            startBalance: $model->start_balance/100,
            currentBalance: $model->currentBalance()/100,
            lastTransactionDate: $model->latestTransactionDate(),
        );
    }

    public static function toModel(BankAccount $bankAccount): array
    {
        return [
            'id' => $bankAccount->id,
            'start_balance' => (int) round($bankAccount->startBalance*100),
            'name' => $bankAccount->name,
            'user_id' => $bankAccount->userId,
        ];
    }
}
