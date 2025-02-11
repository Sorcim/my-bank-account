<?php

namespace App\Infrastructure\Services;

use App\Domain\Services\TransactionProcessingInterface;
use App\Infrastructure\Jobs\ProcessImageTransactionJob;

class TransactionProcessingService implements TransactionProcessingInterface
{

    public function processTransactionFromImage(string $imagePath, string $bankAccountId): void
    {
        ProcessImageTransactionJob::dispatch($imagePath, $bankAccountId)->onQueue('transaction');
    }
}
