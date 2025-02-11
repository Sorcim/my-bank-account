<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Category;

interface CategoryRepository
{
    public function get(string $id): ?Category;
    public function find(array $ids): array;
    public function all(string $userId): array;
    public function create(Category $category): bool;
    public function update(Category $category): bool;
    public function delete(Category $category): bool;
}
