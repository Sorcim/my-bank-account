<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\DTOs\CreateTransactionDTO;
use App\Domain\Repositories\TransactionRepository;
use App\Domain\Services\ImageProcessingService;

class CreateTransactionFromImageUseCase
{
    public function __construct(
        private ImageProcessingService $imageService,
        private TransactionRepository $transactionRepository
    ) {}

    public function execute(string $bankAccountId, string $imagePath): bool
    {
        // Extraire les données de l'image
        $data = $this->imageService->extractDataFromImage($imagePath);

        // Créer une transaction à partir des données
        $transaction = new CreateTransactionDTO(
            $data->description,
            ((float)$data->amount),
            $data->date,
            $bankAccountId,
            $imagePath
        );

        // Sauvegarder la transaction
        return $this->transactionRepository->createTransaction($transaction);
    }
}
