<?php

namespace App\Application\Presenters;

class ListTransactionPresenter
{
    public array $transactions;

    /**
     * @param array $transactions
     */
    public function __construct(array $transactions)
    {
        $this->transactions = $transactions;
    }

    public function toInertia(): array
    {
        return $this->groupByMonth($this->transactions);
    }

    private function groupByMonth(array $transactions): array
    {
        $grouped = [];

        foreach ($transactions as $transaction) {
            $key = $transaction->effectiveAt->format('Y-m');

            if (!isset($grouped[$key])) {
                $grouped[$key] = [];
            }

            // Ajouter la transaction au groupe correspondant
            $grouped[$key][] = [
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'effective_at' => $transaction->effectiveAt->format('Y-m-d'),
                'description' => $transaction->description,
                'checked' => $transaction->checked,
            ];
        }

        return $grouped;
    }

}
