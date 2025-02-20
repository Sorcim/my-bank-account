<?php

namespace App\Application\Controllers\Web\Category;

use App\Application\Requests\Category\EditCategoryRequest;
use App\Application\Services\CategoryUpdater;
use App\Domain\UseCases\Category\EditCategoryUseCase;

class EditCategoryController
{
    public function __construct(private EditCategoryUseCase $editCategoryUseCase, private CategoryUpdater $categoryUpdater) {}

    public function execute(EditCategoryRequest $request, string $id)
    {
        $request->validated();
        $category = $this->editCategoryUseCase->getCategory($id);
        if (! $category) {
            throw new \Exception('Category not found');
        }
        $this->editCategoryUseCase->execute($this->categoryUpdater->update($category, $request->all()));

        return back()->with('success', 'Category updated successfully');
    }
}
