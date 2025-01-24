<?php

namespace App\Domain\Repositories;

use App\Domain\DTOs\CreateBankAccountDTO;
use App\Domain\DTOs\EditBankAccountDTO;

interface BankAccountRepository
{
    public function findAllByUser(string $userId): array;
    public function create(CreateBankAccountDTO $payload): bool;
    public function update(string $id, EditBankAccountDTO $data): bool;
    public function delete(string $id): bool;
}
