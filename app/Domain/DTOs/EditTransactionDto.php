<?php

namespace App\Domain\DTOs;

class EditTransactionDto
{
    public ?string $description;
    public ?float $amount;
    public ?string $effectiveAt;
    public ?bool $checked;

    public function __construct(?string $description, ?float $amount, ?string $effectiveAt, ?bool $checked)
    {
        $this->description = $description;
        $this->amount = $amount;
        $this->effectiveAt = $effectiveAt;
        $this->checked = $checked;
    }
}
