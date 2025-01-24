<?php

namespace App\Domain\Entities;

class BankAccount
{
    public string $id;
    public string $name;
    public float $startBalance;
    public string $userId;
    public array $transactions = [];


    public function __construct(string $id, string $name, float $startBalance, string $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startBalance = $startBalance;
        $this->userId = $userId;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getRemainingBalance()
    {
        $totalTransactions = array_reduce(
            $this->transactions,
            fn($carry, $transaction) => $carry + $transaction->amount,
            0
        );

        return $this->startBalance + $totalTransactions;
    }

    public function getMostRecentTransaction(): ?Transaction
    {
        if (empty($this->transactions)) {
            return null;
        }

        $transactions = $this->transactions; // Copie pour éviter de modifier l'original
        usort($transactions, fn($a, $b) => $b->effectiveAt <=> $a->effectiveAt);

        return $transactions[0] ?? null;
    }
}
