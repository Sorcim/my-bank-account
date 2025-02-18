<?php

namespace App\Domain\Factories;

use App\Domain\Entities\RecurringTransaction;
use Ramsey\Uuid\Uuid;

class RecurringTransactionFactory
{
    public static function create(
        int $amount,
        string $description,
        string $categoryId,
        string $bankAccountId,
        \DateTimeImmutable $startDate,
        \DateTimeImmutable $endDate,
        string $frequency,
    ): RecurringTransaction {
        return new RecurringTransaction(
            id: Uuid::uuid4()->toString(),
            bankAccountId: $bankAccountId,
            amount: $amount,
            description: $description,
            categoryId: $categoryId,
            startAt: $startDate,
            endAt: $endDate,
            frequency: $frequency,
            lastProcessedAt: null,
            nextProcessedAt: $startDate,
        );
    }

    public static function fromArray(array $data): RecurringTransaction
    {
        return new RecurringTransaction(
            id: Uuid::uuid4()->toString(),
            bankAccountId: $data['bank_account_id'],
            amount: $data['amount'],
            description: $data['description'],
            categoryId: $data['category_id'],
            startAt: new \DateTimeImmutable($data['start_at']),
            endAt: new \DateTimeImmutable($data['end_at']),
            frequency: $data['frequency'],
            lastProcessedAt: null,
            nextProcessedAt: new \DateTimeImmutable($data['start_at']),
        );
    }
}
