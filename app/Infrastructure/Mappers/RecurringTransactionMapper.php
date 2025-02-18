<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\RecurringTransaction;
use App\Infrastructure\Persistence\RecurringTransactionModel;

class RecurringTransactionMapper
{
    public static function toEntity(RecurringTransactionModel $recurringTransaction): RecurringTransaction
    {
        return new RecurringTransaction(
            id: $recurringTransaction->id,
            bankAccountId: $recurringTransaction->bank_account_id,
            amount: $recurringTransaction->amount / 100,
            description: $recurringTransaction->description,
            categoryId: $recurringTransaction->category_id,
            startAt: new \DateTimeImmutable($recurringTransaction->start_at),
            endAt: new \DateTimeImmutable($recurringTransaction->end_at),
            frequency: $recurringTransaction->frequency,
            lastProcessedAt: new \DateTimeImmutable($recurringTransaction->lastProcessedAt),
            nextProcessedAt: new \DateTimeImmutable($recurringTransaction->nextProcessedAt)
        );
    }

    public static function toModel(RecurringTransaction $recurringTransaction): array
    {
        return [
            'id' => $recurringTransaction->id,
            'bank_account_id' => $recurringTransaction->bankAccountId,
            'amount' => (int) round($recurringTransaction->amount * 100),
            'description' => $recurringTransaction->description,
            'category_id' => $recurringTransaction->categoryId,
            'start_at' => $recurringTransaction->startAt,
            'end_at' => $recurringTransaction->endAt,
            'frequency' => $recurringTransaction->frequency,
            'lastProcessed_at' => $recurringTransaction->lastProcessedAt,
            'nextProcessed_at' => $recurringTransaction->nextProcessedAt,
        ];
    }
}
