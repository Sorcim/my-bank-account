<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Entities\PaginatedRecurringTransactions;
use App\Domain\Entities\RecurringTransaction;
use App\Domain\Repositories\RecurringTransactionRepository;
use App\Infrastructure\Mappers\RecurringTransactionMapper;
use App\Infrastructure\Persistence\RecurringTransactionModel;
use Illuminate\Database\Eloquent\Builder;

class EloquentRecurringTransactionRepository implements RecurringTransactionRepository
{
    public function getByUserId(string $userId, int $page, int $perPage): PaginatedRecurringTransactions
    {
        $paginator = RecurringTransactionModel::whereHas('bankAccount', function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })->paginate(page: $page, perPage: $perPage);
        $transactions = $paginator->map(function (RecurringTransactionModel $recurringTransaction) {
            return RecurringTransactionMapper::toEntity($recurringTransaction);
        })->toArray();

        return new PaginatedRecurringTransactions(
            transactions: $transactions,
            currentPage: $paginator->currentPage(),
            lastPage: $paginator->lastPage(),
            perPage: $paginator->perPage(),
            total: $paginator->total()
        );
    }

    public function create(RecurringTransaction $recurringTransaction): bool
    {
        return RecurringTransactionModel::create(RecurringTransactionMapper::toModel($recurringTransaction))->save();
    }

    public function update(RecurringTransaction $recurringTransaction): bool
    {
        return RecurringTransactionModel::find($recurringTransaction->id)->update(RecurringTransactionMapper::toModel($recurringTransaction));
    }

    public function delete(RecurringTransaction $recurringTransaction): bool
    {
        return RecurringTransactionModel::destroy($recurringTransaction->id);
    }

    public function get(string $id): RecurringTransaction
    {
        $transaction = RecurringTransactionModel::find($id);

        return RecurringTransactionMapper::toEntity($transaction);
    }

    public function getRecurringTransactionToProcess(): array
    {
        $now = new \DateTimeImmutable;
        $transactions = RecurringTransactionModel::where('next_processed_at', '=', $now->format('Y-m-d'))->get();

        return $transactions->map(function (RecurringTransactionModel $transaction) {
            return RecurringTransactionMapper::toEntity($transaction);
        })->toArray();
    }
}
