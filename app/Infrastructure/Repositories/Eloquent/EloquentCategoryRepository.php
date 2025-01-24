<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\DTOs\CreateCategoryDTO;
use App\Domain\DTOs\EditCategoryDTO;
use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepository;
use App\Infrastructure\Persistence\CategoryModel;

class EloquentCategoryRepository implements CategoryRepository
{

    public function all(string $userId): array
    {
        $categories = CategoryModel::where('user_id', $userId)
            ->get();

        $categories->transform(function ($category) {
            return new Category(
                $category->id,
                $category->name,
                $category->color,
            );
        });
        return $categories->toArray();
    }

    public function create(CreateCategoryDTO $data): bool
    {
        return CategoryModel::create([
            'name' => $data->name,
            'color' => $data->color,
            'user_id' => $data->userId
        ])->save();
    }

    public function update(string $categoryId, EditCategoryDTO $data): bool
    {
        $category = CategoryModel::find($categoryId);
        $category->name = $data->name;
        $category->color = $data->color;
        return $category->save();
    }

    public function delete(string $categoryId): bool
    {
        return CategoryModel::destroy($categoryId);
    }
}
