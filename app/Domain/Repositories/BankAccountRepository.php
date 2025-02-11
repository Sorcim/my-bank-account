<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\BankAccount;
use App\Domain\Entities\PaginatedBankAccountSummary;

interface BankAccountRepository
{
    public function findAllByUser(string $userId, int $page, int $perPage = 12): PaginatedBankAccountSummary;
    public function create(BankAccount $bankAccount): bool;
    public function update(BankAccount $bankAccount): bool;
    public function delete(string $id): bool;
    public function get(string $bankAccountId): ?BankAccount;
}
