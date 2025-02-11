<?php

namespace App\Domain\Factories;

use App\Domain\Entities\BankAccount;
use App\Domain\Entities\Category;
use Ramsey\Uuid\Uuid;

class CategoryFactory {
    public static function create(string $name, string $color, string $userId) {
        return new Category(
            id: Uuid::uuid4()->toString(),
            name: $name,
            color: $color,
            userId: $userId,
        );
    }
}
