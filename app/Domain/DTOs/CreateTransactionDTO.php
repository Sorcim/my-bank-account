<?php

namespace App\Domain\DTOs;

class CreateTransactionDTO
{
    public function __construct(
        public string $description,
        public float $amount,
        public string $effectiveAt,
        public string $bankAccountId,
        public ?string $receiptPath
    ) {}
}
