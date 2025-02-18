<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Entities\PaginatedTransactions;
use App\Domain\Entities\Transaction;
use App\Domain\Repositories\TransactionRepository;
use App\Infrastructure\Mappers\TransactionMapper;
use App\Infrastructure\Persistence\TransactionModel;

class EloquentTransactionRepository implements TransactionRepository
{
    public function getListTransactionsForBankAccount(string $bankAccountId, ?int $limit): array
    {
        $transactions = TransactionModel::where('bank_account_id', $bankAccountId)
            ->orderByDesc('effective_at');

        if (! is_null($limit)) {
            $transactions = $transactions->limit($limit);
        }

        $transactions = $transactions->get();

        $transactions->transform(function ($transaction) {
            return TransactionMapper::toEntity($transaction);
        });

        return $transactions->toArray();
    }

    public function create(Transaction $transaction): bool
    {
        return TransactionModel::create(TransactionMapper::toModel($transaction))->save();
    }

    public function delete(Transaction $transaction): bool
    {
        return TransactionModel::destroy($transaction->id);
    }

    public function update(Transaction $transaction): bool
    {
        return TransactionModel::find($transaction->id)->update(TransactionMapper::toModel($transaction));
    }

    public function findPaginatedByBankAccountId(string $bankAccountId, int $perPage, int $page): PaginatedTransactions
    {
        $paginator = TransactionModel::where('bank_account_id', $bankAccountId)
            ->orderByDesc('effective_at')
            ->paginate($perPage, ['*'], 'page', $page);

        $transactions = $paginator->map(fn ($transaction) => TransactionMapper::toEntity($transaction))->toArray();

        return new PaginatedTransactions(
            $transactions,
            $paginator->currentPage(),
            $paginator->lastPage(),
            $paginator->perPage(),
            $paginator->total()
        );
    }

    public function get(string $transactionId): Transaction
    {
        $transaction = TransactionModel::find($transactionId);

        return TransactionMapper::toEntity($transaction);
    }
}
