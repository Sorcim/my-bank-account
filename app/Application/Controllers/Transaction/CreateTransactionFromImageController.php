<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Requests\Transaction\CreateTransactionFromImageRequest;
use App\Infrastructure\Jobs\ProcessImageAndCreateTransaction;

class CreateTransactionFromImageController
{
    public function execute(CreateTransactionFromImageRequest $request)
    {
        $request->validated();

        foreach ($request->images as $image) {
            $imagePath = $image->store('receipts');

            ProcessImageAndCreateTransaction::dispatch($request->get('bank_account_id'), $imagePath);
        }

        return back()->with('success', 'Transaction created successfully');
    }

}
