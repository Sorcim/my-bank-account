<?php

namespace App\Domain\UseCases\Category;

use App\Domain\Repositories\CategoryRepository;

class ShowListCategoryUseCase
{

    public function __construct(private CategoryRepository $categoryRepository)
    {}

    public function execute(string $userId): array
    {
        return $this->categoryRepository->all($userId);
    }
}
