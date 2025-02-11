<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Factories\TransactionFactory;
use App\Domain\Repositories\TransactionRepository;
use App\Domain\Services\ImageProcessingInterface;
use DateTimeImmutable;

class ProcessTransactionFromImageUseCase
{
    public function __construct(
        private ImageProcessingInterface $imageProcessor,
        private TransactionRepository $transactionRepository
    ) {}

    public function execute(string $imagePath, string $bankAccountId): void
    {
        $imageProcessingDTO = $this->imageProcessor->extractDataFromImage($imagePath);

        if (!$imageProcessingDTO->amount || !$imageProcessingDTO->date || !$imageProcessingDTO->description) {
            throw new \Exception("Impossible d’extraire les données du ticket CB.");
        }

        $transaction = TransactionFactory::create(
            amount: $imageProcessingDTO->amount*100,
            description: $imageProcessingDTO->description,
            effectiveAt: new DateTimeImmutable($imageProcessingDTO->date),
            bankAccountId: $bankAccountId,
        );

        $this->transactionRepository->create($transaction);
    }
}
