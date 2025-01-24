<?php

namespace App\Application\Controllers\Category;

use App\Application\Requests\Category\CreateCategoryRequest;
use App\Domain\DTOs\CreateCategoryDTO;
use App\Domain\UseCases\Category\CreateCategoryUseCase;

class CreateCategoryController
{
    public function __construct(private CreateCategoryUseCase $createCategoryUseCase)
    {
    }

    public function execute(CreateCategoryRequest $request)
    {
       $request->validated();
       $dto = new CreateCategoryDTO($request->get('name'), $request->get('color'), auth()->id());
       $this->createCategoryUseCase->execute($dto);
       return back()->with('success', 'Category created successfully');
    }
}
