<?php

namespace App\Domain\UseCases\Category;

use App\Domain\Repositories\CategoryRepository;

class DeleteCategoryUseCase
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function execute(string $id): void
    {
        $this->categoryRepository->delete($id);
    }
}
