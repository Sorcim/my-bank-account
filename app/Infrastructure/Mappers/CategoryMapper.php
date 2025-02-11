<?php

namespace App\Infrastructure\Mappers;

use App\Domain\Entities\Category;
use App\Infrastructure\Persistence\CategoryModel;

class CategoryMapper {
    public static function toEntity(CategoryModel $model): Category
    {
        return new Category(
            id: $model->id,
            name: $model->name,
            color: $model->color,
            userId: $model->user->id
        );
    }

    public static function toModel(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'color' => $category->color,
        ];
    }
}
