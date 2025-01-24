<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\DTOs\CreateBankAccountDTO;
use App\Domain\DTOs\EditBankAccountDTO;
use App\Domain\Entities\BankAccount;
use App\Domain\Entities\Transaction;
use App\Domain\Repositories\BankAccountRepository;
use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Persistence\UserModel;

class EloquentBankAccountRepository implements BankAccountRepository
{

    public function findAllByUser(string $userId): array
    {
        $bankAccounts = BankAccountModel::with(['transactions'])->get();

        return $bankAccounts->map(function ($bankAccount) {
            $account = new BankAccount(
                $bankAccount->id,
                $bankAccount->name,
                $bankAccount->start_balance,
                auth()->user()->id
            );

            foreach ($bankAccount->transactions as $transaction) {
                $account->addTransaction(
                    new Transaction(
                        $transaction->id,
                        $transaction->bank_account_id,
                        $transaction->amount,
                        $transaction->description,
                        new \DateTimeImmutable($transaction->date)
                    )
                );
            }

            return $account;
        })->toArray();
    }

    public function create(CreateBankAccountDTO $payload): bool
    {
        $bankAccount = new BankAccountModel();
        $bankAccount->name = $payload->name;
        $bankAccount->start_balance = $payload->startBalance;
        $user = UserModel::find($payload->userId);
        $bankAccount->user()->associate($user);
        return $bankAccount->save();
    }

    public function update(string $id, EditBankAccountDTO $data): bool
    {
        $bankAccount = BankAccountModel::find($id);
        if (!is_null($bankAccount->name)) {
            $bankAccount->name = $data->name;
        }
        if (!is_null($bankAccount->start_balance)) {
            $bankAccount->start_balance = $data->startBalance;
        }
        return $bankAccount->save();
    }

    public function delete(string $id): bool
    {
        return BankAccountModel::destroy($id);
    }
}
