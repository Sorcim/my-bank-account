<?php

namespace App\Application\Controllers\Api\Category;

use App\Application\Resources\CategoryResource;
use App\Domain\UseCases\Category\GetListCategoryUseCase;

class ApiGetCategoryForCurrentUserController
{
    public function __construct(private GetListCategoryUseCase $getListCategoryUseCase) {}

    public function execute()
    {
        try {
            $categories = $this->getListCategoryUseCase->execute(auth()->id());

            return response()->json([
                'data' => CategoryResource::collection($categories),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
