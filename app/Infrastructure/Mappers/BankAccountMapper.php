<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\BankAccount;
use App\Infrastructure\Persistence\BankAccountModel;

class BankAccountMapper {
    public static function toEntity(BankAccountModel $model): BankAccount
    {
        return new BankAccount(
            id: $model->id,
            name: $model->name,
            startBalance: $model->amount/100,
            userId: $model->user->id
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
