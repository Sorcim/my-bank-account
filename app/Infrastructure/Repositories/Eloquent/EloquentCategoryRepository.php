<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepository;
use App\Infrastructure\Mappers\CategoryMapper;
use App\Infrastructure\Persistence\CategoryModel;

class EloquentCategoryRepository implements CategoryRepository
{
    public function get(string $id): ?Category
    {
        $categoryModel = CategoryModel::where("id", $id)->first();
        if (is_null($categoryModel)) {
            return null;
        }
        return CategoryMapper::toEntity($categoryModel);
    }

    public function all(string $userId): array
    {
        $categories = CategoryModel::where('user_id', $userId)
            ->get();

        $categories->transform(function ($category) {
            return CategoryMapper::toEntity($category);
        });
        return $categories->toArray();
    }

    public function create(Category $category): bool
    {
        return CategoryModel::create(CategoryMapper::toModel($category))->save();
    }

    public function update(Category $category): bool
    {
        return CategoryModel::find($category->id)->update(CategoryMapper::toModel($category));
    }

    public function delete(Category $category): bool
    {
        return CategoryModel::destroy($category->id);
    }

    public function find(array $ids): array
    {
        $categories = CategoryModel::findMany($ids);
        $categories->transform(function ($category) {
            return CategoryMapper::toEntity($category);
        });
        return $categories->toArray();
    }
}
