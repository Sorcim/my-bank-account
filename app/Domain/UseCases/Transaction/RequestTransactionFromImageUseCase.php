<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Services\TransactionProcessingInterface;

class RequestTransactionFromImageUseCase {
    public function __construct(
        private TransactionProcessingInterface $transactionProcessingService
    ) {}

    public function execute(array $images, string $bankAccountId): void
    {
        foreach ($images as $image) {
            $this->transactionProcessingService->processTransactionFromImage($image, $bankAccountId);
        }
    }
}
