<?php

namespace App\Domain\UseCases\Category;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepository;

class CreateCategoryUseCase
{

    public function __construct(private CategoryRepository $categoryRepository)
    {}

    public function execute(Category $category)
    {
        return $this->categoryRepository->create($category);
    }
}
