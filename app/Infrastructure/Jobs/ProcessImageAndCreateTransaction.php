<?php

namespace App\Infrastructure\Jobs;

use App\Domain\UseCases\Transaction\CreateTransactionFromImageUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImageAndCreateTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $imagePath;
    private string $bankAccountId;

    public function __construct(string $bankAccountId, string $imagePath)
    {
        $this->bankAccountId = $bankAccountId;
        $this->imagePath = $imagePath;
    }

    public function handle(CreateTransactionFromImageUseCase $createTransactionFromImageUseCase) {
        $createTransactionFromImageUseCase->execute($this->bankAccountId, $this->imagePath);
    }
}
