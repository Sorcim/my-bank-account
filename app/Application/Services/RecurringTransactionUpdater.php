<?php

namespace App\Application\Services;

use App\Domain\Entities\RecurringTransaction;

class RecurringTransactionUpdater
{
    public static function update(RecurringTransaction $transaction, array $data): RecurringTransaction
    {
        if (isset($data['amount'])) {
            $transaction->amount = (float) $data['amount'];
        }
        if (isset($data['description'])) {
            $transaction->description = $data['description'];
        }
        if (isset($data['start_at'])) {
            $transaction->startAt = new \DateTimeImmutable($data['start_at']);
        }
        if (isset($data['end_at'])) {
            $transaction->endAt = new \DateTimeImmutable($data['end_at']);
        }
        if (isset($data['category_id'])) {
            $transaction->categoryId = $data['category_id'];
        }
        if (isset($data['bank_account_id'])) {
            $transaction->bankAccountId = $data['bank_account_id'];
        }
        if (isset($data['frequency'])) {
            $transaction->frequency = $data['frequency'];
        }

        return $transaction;
    }
}
