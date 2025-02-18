<?php

namespace App\Infrastructure\Repositories\Eloquent;

use App\Domain\Entities\BankAccount;
use App\Domain\Entities\PaginatedBankAccountSummary;
use App\Domain\Repositories\BankAccountRepository;
use App\Infrastructure\Mappers\BankAccountMapper;
use App\Infrastructure\Mappers\BankAccountSummaryMapper;
use App\Infrastructure\Persistence\BankAccountModel;

class EloquentBankAccountRepository implements BankAccountRepository
{
    public function findAllByUser(string $userId, int $page, int $perPage = 12): PaginatedBankAccountSummary
    {
        $paginator = BankAccountModel::where('user_id', $userId)
            ->paginate($perPage, ['*'], 'page', $page);

        $bankAccounts = $paginator->map(fn ($bankAccount) => BankAccountSummaryMapper::toEntity($bankAccount))->toArray();

        return new PaginatedBankAccountSummary(
            $bankAccounts,
            $paginator->currentPage(),
            $paginator->lastPage(),
            $paginator->perPage(),
            $paginator->total()
        );
    }

    public function create(BankAccount $bankAccount): bool
    {
        return BankAccountModel::create(BankAccountMapper::toModel($bankAccount))->save();
    }

    public function update(BankAccount $bankAccount): bool
    {
        return BankAccountModel::where('id', $bankAccount->id)->update(BankAccountMapper::toModel($bankAccount));
    }

    public function delete(string $id): bool
    {
        return BankAccountModel::destroy($id);
    }

    public function get(string $bankAccountId): ?BankAccount
    {
        $bankAccountModel = BankAccountModel::where('id', $bankAccountId)->first();
        if (is_null($bankAccountModel)) {
            return null;
        }

        return BankAccountMapper::toEntity($bankAccountModel);
    }

    public function getAllByUserId(string $userId): array
    {
        $bankAccounts = BankAccountModel::where('user_id', $userId)->get();
        $bankAccounts = $bankAccounts->map(fn ($bankAccount) => BankAccountMapper::toEntity($bankAccount));

        return $bankAccounts->toArray();
    }
}
