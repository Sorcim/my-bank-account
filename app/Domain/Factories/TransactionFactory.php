<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Transaction;
use Ramsey\Uuid\Uuid;

class TransactionFactory {
    public static function create(int $amount, string $description, \DateTimeImmutable $effectiveAt, string $bankAccountId, string $categoryId = null, bool $checked = false, string $receiptPath = null): Transaction
    {
        return new Transaction(
            id: Uuid::uuid4()->toString(),
            amount: $amount,
            description: $description,
            effectiveAt: $effectiveAt,
            bankAccountId: $bankAccountId,
            categoryId: $categoryId,
            checked: $checked,
            receiptPath: $receiptPath
        );
    }

    public static function fromArray(array $data): Transaction
    {
        return new Transaction(
            id: $data['id'] ?? Uuid::uuid4()->toString(),
            amount: $data['amount'],
            description: $data['description'],
            effectiveAt: new \DateTimeImmutable($data['effective_at']),
            bankAccountId: $data['bank_account_id'],
            categoryId: $data['category_id'] ?? null,
            checked: $data['checked'] ?? false,
            receiptPath: $data['receipt_path'] ?? null,
        );
    }

    public static function fromImage(string $bankAccountId, string $imagePath): Transaction
    {
        return new Transaction(
            id: Uuid::uuid4()->toString(),
            amount: 0,
            description: '',
            effectiveAt: new \DateTimeImmutable(),
            bankAccountId: $bankAccountId,
            categoryId: null,
            checked: false,
            receiptPath: $imagePath,
        );
    }
}
