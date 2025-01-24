<?php

namespace App\Application\Controllers\Category;

use App\Application\Requests\Category\EditCategoryRequest;
use App\Domain\DTOs\EditCategoryDTO;
use App\Domain\UseCases\Category\EditCategoryUseCase;

class EditCategoryController
{

    public function __construct(private EditCategoryUseCase $editCategoryUseCase)
    {
    }

    public function execute(EditCategoryRequest $request, string $id)
    {
        $request->validated();
        $dto = new EditCategoryDTO($request->get('name'), $request->get('color'));
        $this->editCategoryUseCase->execute($id, $dto);
        return back()->with('success', 'Category updated successfully');
    }
}
