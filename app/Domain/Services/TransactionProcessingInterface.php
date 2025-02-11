<?php

namespace App\Domain\Services;

interface TransactionProcessingInterface {
    public function processTransactionFromImage(string $imagePath, string $bankAccountId): void;
}
