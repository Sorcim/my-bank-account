<?php

namespace App\Application\Controllers\Web\Category;

use App\Domain\UseCases\Category\ShowListCategoryUseCase;
use Inertia\Inertia;

class ShowListCategoryController
{
    public function __construct(private ShowListCategoryUseCase $showListCategoryUseCase) {}

    public function render()
    {
        $categories = $this->showListCategoryUseCase->execute(auth()->id());

        return Inertia::render('Categories/ListCategories', ['categories' => $categories]);
    }
}
