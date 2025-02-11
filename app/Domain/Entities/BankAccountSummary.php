<?php

namespace App\Domain\Entities;

class BankAccountSummary {
    public string $id;
    public string $name;
    public float $currentBalance;
    public float $startBalance;
    public ?\DateTimeImmutable $lastTransactionDate;

    public function __construct(string $id, string $name, float $startBalance, float $currentBalance, ?\DateTimeImmutable $lastTransactionDate=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startBalance = $startBalance;
        $this->currentBalance = $currentBalance;
        $this->lastTransactionDate = $lastTransactionDate;
    }
}
