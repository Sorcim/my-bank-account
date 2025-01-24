<?php

namespace App\Domain\DTOs;

class CreateBankAccountDTO
{
    public function __construct(public string $name, public float $startBalance, public string $userId) {}
}
