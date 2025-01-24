<?php

namespace App\Application\Controllers\Category;

use App\Domain\UseCases\Category\DeleteCategoryUseCase;

class DeleteCategoryController
{
    public function __construct(private DeleteCategoryUseCase $deleteCategoryUseCase)
    {}

    public function execute(string $categoryId)
    {
        $this->deleteCategoryUseCase->execute($categoryId);
        return back()->with('success', 'Category deleted successfully');
    }
}
