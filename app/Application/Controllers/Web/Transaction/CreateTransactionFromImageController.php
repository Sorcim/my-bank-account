<?php

namespace App\Application\Controllers\Web\Transaction;

use App\Application\Requests\Transaction\CreateTransactionFromImageRequest;
use App\Domain\UseCases\Transaction\RequestTransactionFromImageUseCase;

class CreateTransactionFromImageController
{
    public function __construct(private RequestTransactionFromImageUseCase $requestTransactionFromImageUseCase) {}

    public function execute(CreateTransactionFromImageRequest $request)
    {
        $request->validated();
        $paths = [];
        foreach ($request->images as $image) {
            $paths[] = $image->store('receipts');
        }
        $this->requestTransactionFromImageUseCase->execute($paths, $request->get('bank_account_id'));

        return back()->with('success', 'Transaction created successfully');
    }
}
