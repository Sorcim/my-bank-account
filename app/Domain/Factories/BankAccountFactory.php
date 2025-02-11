<?php

namespace App\Domain\Factories;

use App\Domain\Entities\BankAccount;
use Ramsey\Uuid\Uuid;

class BankAccountFactory {
    public static function create(string $name, float $startBalance, string $userId) {
        return new BankAccount(
            id: Uuid::uuid4()->toString(),
            name: $name,
            startBalance: $startBalance,
            userId: $userId
        );
    }
}
