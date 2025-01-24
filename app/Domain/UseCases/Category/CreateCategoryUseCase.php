<?php

namespace App\Domain\UseCases\Category;

use App\Domain\DTOs\CreateCategoryDTO;
use App\Domain\Repositories\CategoryRepository;

class CreateCategoryUseCase
{

    public function __construct(private CategoryRepository $categoryRepository)
    {}

    public function execute(CreateCategoryDTO $createCategoryDTO)
    {
        return $this->categoryRepository->create($createCategoryDTO);
    }
}
