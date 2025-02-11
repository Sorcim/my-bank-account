<?php

namespace App\Domain\Entities;

class Transaction
{
    public string $id;
    public float $amount;
    public string $description;
    public \DateTimeImmutable $effectiveAt;
    public string $bankAccountId;
    public ?string $categoryId = null;
    public bool $checked = false;
    public ?string $receiptPath = null;

    public function __construct(
        string $id,
        float $amount,
        string $description,
        \DateTimeImmutable $effectiveAt,
        string $bankAccountId,
        ?string $categoryId = null,
        ?bool $checked = false,
        ?string $receiptPath = null
    ) {
        $this->id = $id;
        $this->amount = $amount;
        $this->description = $description;
        $this->effectiveAt = $effectiveAt;
        $this->bankAccountId = $bankAccountId;
        $this->categoryId = $categoryId;
        $this->checked = $checked ?? false;
        $this->receiptPath = $receiptPath;
    }
}
