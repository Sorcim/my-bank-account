<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\Transaction;
use App\Infrastructure\Persistence\TransactionModel;
use DateTimeImmutable;

class TransactionMapper {

   public static function toEntity(TransactionModel $model): Transaction
    {
        return new Transaction(
            id: $model->id,
            amount: $model->amount/100,
            description: $model->description,
            effectiveAt: new DateTimeImmutable($model->effective_at),
            bankAccountId: $model->bank_account_id,
            categoryId: $model->category_id,
            checked: $model->checked,
            receiptPath: $model->receiptPath
        );
    }

    public static function toModel(Transaction $transaction): array
    {
        return [
            'id' => $transaction->id,
            'amount' => (int) round($transaction->amount * 100),
            'description' => $transaction->description,
            'effective_at' => $transaction->effectiveAt,
            'bank_account_id' => $transaction->bankAccountId,
            'category_id' => $transaction->categoryId,
            'checked' => $transaction->checked,
            'receipt_path' => $transaction->receiptPath
        ];
    }
}
