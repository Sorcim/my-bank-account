<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Entities\Transaction;
use App\Domain\Repositories\BankAccountRepository;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\TransactionRepository;

class CreateTransactionUseCase
{
    public function __construct(
        private TransactionRepository $transactionRepository,
        private BankAccountRepository $bankAccountRepository,
        private CategoryRepository $categoryRepository
    )
    {}

    public function execute(Transaction $transaction): bool
    {
        $bankAccount = $this->bankAccountRepository->get($transaction->bankAccountId);
        if (!$bankAccount) {
            throw new \Exception("Bank account not found");
        }
        if ($transaction->categoryId && $this->categoryRepository->get($transaction->categoryId) === null)
        {
            throw new \Exception("Category not found");
        }
        return $this->transactionRepository->create($transaction);
    }
}
