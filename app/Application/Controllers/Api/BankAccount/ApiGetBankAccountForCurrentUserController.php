<?php

namespace App\Application\Controllers\Api\BankAccount;

use App\Application\Resources\BankAccountResource;
use App\Domain\UseCases\BankAccount\GetListBankAccountForUserUseCase;
use Illuminate\Http\JsonResponse;

class ApiGetBankAccountForCurrentUserController
{
    public function __construct(private GetListBankAccountForUserUseCase $getListBankAccountForUserUseCase) {}

    public function execute(): JsonResponse
    {
        try {
            $bankAccounts = $this->getListBankAccountForUserUseCase->execute(auth()->id());

            \Illuminate\Log\log('test', [$bankAccounts]);

            return response()->json([
                'data' => BankAccountResource::collection($bankAccounts),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
