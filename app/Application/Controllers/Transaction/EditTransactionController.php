<?php

namespace App\Application\Controllers\Transaction;

use App\Application\Requests\Transaction\EditTransactionRequest;
use App\Domain\DTOs\EditTransactionDto;
use App\Domain\UseCases\Transaction\EditTransactionUseCase;

class EditTransactionController
{

    public function __construct(private EditTransactionUseCase $editTransactionUseCase)
    {
    }

    public function execute(EditTransactionRequest $request, string $transactionId)
    {
        $request->validated();
        $edtTransactionDTO = new EditTransactionDTO(
            $request->get('description'),
            $request->get('amount'),
            $request->get('effective_at'),
            $request->get('checked'),
        );
        $this->editTransactionUseCase->execute($transactionId, $edtTransactionDTO);
    }
}
