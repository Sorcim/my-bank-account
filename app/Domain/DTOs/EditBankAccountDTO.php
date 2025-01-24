<?php

namespace App\Domain\DTOs;

class EditBankAccountDTO
{
    public string $name;
    public float $startBalance;

    public function __construct(?string $name, ?float $startBalance)
    {
        $this->name = $name;
        $this->startBalance = $startBalance;
    }
}
