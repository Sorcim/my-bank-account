<?php

namespace App\Application\Controllers\Api\Transaction;

use App\Application\Requests\Transaction\CreateTransactionRequest;
use App\Domain\Factories\TransactionFactory;
use App\Domain\UseCases\Transaction\CreateTransactionUseCase;
use Illuminate\Http\JsonResponse;

class ApiCreateTransactionController
{
    public function __construct(private CreateTransactionUseCase $createTransactionUseCase) {}

    public function execute(CreateTransactionRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $transaction = TransactionFactory::fromArray($request->all());
            $result = $this->createTransactionUseCase->execute($transaction);
            if (! $result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating transaction',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Transaction created',
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => 'false', 'message' => $e->getMessage()], 400);
        }
    }
}
