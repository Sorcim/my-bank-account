<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\DTOs\CreateTransactionDTO;
use App\Domain\DTOs\EditTransactionDto;
use App\Domain\Entities\Transaction;
use App\Domain\Repositories\TransactionRepository;
use App\Infrastructure\Persistence\TransactionModel;
use DateTimeImmutable;

class EloquentTransactionRepository implements TransactionRepository
{
    public function getListTransactionsForBankAccount(string $bankAccountId): array
    {
        $transactions = TransactionModel::where('bank_account_id', $bankAccountId)
            ->orderBy('effective_at', 'desc')
            ->get();

        $transactions->transform(function ($transaction) {
            return new Transaction(
                $transaction->id,
                $transaction->bank_account_id,
                $transaction->amount,
                $transaction->description,
                new DateTimeImmutable($transaction->effective_at),
                $transaction->checked
            );
        });
        return $transactions->toArray();
    }

    public function create(CreateTransactionDTO $createTransactionDto): bool
    {
        return TransactionModel::create([
            'bank_account_id' => $createTransactionDto->bankAccountId,
            'amount' => $createTransactionDto->amount,
            'effective_at' => $createTransactionDto->effectiveAt,
            'description' => $createTransactionDto->description,
        ])->save();
    }

    public function delete(string $transactionId): bool
    {
        return TransactionModel::destroy($transactionId);
    }

    public function update(string $transactionId, EditTransactionDto $editTransactionDto): bool
    {
        $transaction = TransactionModel::find($transactionId);

        $transaction->amount = $editTransactionDto->amount ?? $transaction->amount;
        $transaction->effective_at = $editTransactionDto->effectiveAt ?? $transaction->effective_at;
        $transaction->description = $editTransactionDto->description ?? $transaction->description;
        $transaction->checked = $editTransactionDto->checked ?? $transaction->checked;

        return $transaction->save();
    }
}
