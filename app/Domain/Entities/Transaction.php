<?php

namespace App\Domain\Entities;

class Transaction
{
    public function __construct(
        public  string $id,
        public  string $bankAccountId,
        public  float $amount,
        public  string $description,
        public  \DateTimeImmutable $effectiveAt,
        public  ?bool $checked = null,
        public  ?Category $category = null,
    )
    {
    }

//    public function addCategory(Category $category): void
//    {
//        $this->category = $category;
//    }
}
