<?php

namespace App\Domain\UseCases\Category;

use App\Domain\DTOs\EditCategoryDTO;
use App\Domain\Repositories\CategoryRepository;

class EditCategoryUseCase
{

    public function __construct(private CategoryRepository $categoryRepository)
    {}

    public function execute(string $id, EditCategoryDTO $data): bool
    {
        return $this->categoryRepository->update($id, $data);
    }
}
