<?php

namespace App\Application\Controllers\Api\Transaction;

use App\Application\Requests\Transaction\CreateTransactionFromImageRequest;
use App\Domain\UseCases\Transaction\RequestTransactionFromImageUseCase;
use Illuminate\Http\JsonResponse;

class ApiCreateTransactionFromImageController
{
    public function __construct(private RequestTransactionFromImageUseCase $requestTransactionFromImageUseCase) {}

    public function index(CreateTransactionFromImageRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $paths = [];
            foreach ($request->images as $image) {
                $paths[] = $image->store('receipts');
            }
            $this->requestTransactionFromImageUseCase->execute($paths, $request->get('bank_account_id'));

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully',
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'success' => false,
            ], 400);
        }
    }
}
