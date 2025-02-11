<?php

namespace App\Application\Services;

use App\Domain\Entities\Transaction;

class TransactionUpdater {
    public function update(Transaction $transaction, array $data): Transaction
    {
        if (isset($data['amount'])) {
            $transaction->amount =  (float)$data['amount'];
        }
        if (isset($data['description'])) {
            $transaction->description = $data['description'];
        }
        if (isset($data['effective_at'])) {
            $transaction->effectiveAt = new \DateTimeImmutable($data['effective_at']);
        }
        if (isset($data['category_id'])) {
            $transaction->categoryId = $data['category_id'];
        }
        return $transaction;
    }
}
