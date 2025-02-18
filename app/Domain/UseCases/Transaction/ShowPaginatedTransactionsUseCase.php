<?php

namespace App\Domain\UseCases\Transaction;

use App\Domain\Entities\PaginatedTransactions;
use App\Domain\Repositories\CategoryRepository;
use App\Domain\Repositories\TransactionRepository;

class ShowPaginatedTransactionsUseCase
{
    public function __construct(
        private TransactionRepository $transactionRepository,
        private CategoryRepository $categoryRepository
    ) {}

    public function execute(string $bankAccountId, int $perPage = 10, int $page = 1): PaginatedTransactions
    {
        $paginatedTransactions = $this->transactionRepository->findPaginatedByBankAccountId($bankAccountId, $perPage, $page);

        $categoryIds = array_unique(
            array_filter(array_map(fn ($t) => $t->categoryId, $paginatedTransactions->transactions))
        );

        $categories = $this->categoryRepository->find($categoryIds);

        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->id] = $category;
        }

        $paginatedTransactions->transactions = array_map(function ($transaction) use ($categoriesById) {
            $category = $transaction->categoryId && isset($categoriesById[$transaction->categoryId])
                ? $categoriesById[$transaction->categoryId]
                : null;

            $transaction->category = $category;

            return $transaction;
        }, $paginatedTransactions->transactions);

        return $paginatedTransactions;
    }
}
