<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\CreateCategoryDTO;
use App\Domain\DTOs\EditCategoryDTO;

interface CategoryRepository
{
    public function all(string $userId): array;
    public function create(CreateCategoryDTO $data): bool;
    public function update(string $categoryId, EditCategoryDTO $data): bool;
    public function delete(string $categoryId): bool;
}
