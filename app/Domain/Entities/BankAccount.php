<?php

namespace App\Domain\Entities;

class BankAccount
{
    public string $id;
    public string $name;
    public float $startBalance;
    public string $userId;

    public function __construct(string $id, string $name, float $startBalance, string $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->startBalance = $startBalance;
        $this->userId = $userId;
    }
}
