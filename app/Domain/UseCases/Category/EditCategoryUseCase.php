<?php

namespace App\Domain\UseCases\Category;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepository;

class EditCategoryUseCase
{

    public function __construct(private CategoryRepository $categoryRepository)
    {}

    public function execute(Category $category): bool
    {
        return $this->categoryRepository->update($category);
    }

    public function getCategory(int $id): Category
    {
        return $this->categoryRepository->get($id);
    }
}
