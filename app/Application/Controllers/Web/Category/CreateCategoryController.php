<?php

namespace App\Application\Controllers\Web\Category;

use App\Application\Requests\Category\CreateCategoryRequest;
use App\Domain\Factories\CategoryFactory;
use App\Domain\UseCases\Category\CreateCategoryUseCase;

class CreateCategoryController
{
    public function __construct(private CreateCategoryUseCase $createCategoryUseCase) {}

    public function execute(CreateCategoryRequest $request)
    {
        $request->validated();
        $this->createCategoryUseCase->execute(CategoryFactory::create($request->get('name'), $request->get('color'), auth()->id()));

        return back()->with('success', 'Category created successfully');
    }
}
