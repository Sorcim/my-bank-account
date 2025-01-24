<?php

namespace App\Application\Controllers\BankAccount;

use App\Application\Requests\BankAccount\CreateBankAccountRequest;
use App\Domain\DTOs\CreateBankAccountDTO;
use App\Domain\UseCases\BankAccount\CreateBankAccount;

class CreateBankAccountController
{

    public function __construct(private CreateBankAccount $createBankAccount)
    {
    }

    public function execute(CreateBankAccountRequest $request)
    {
        $payload = $request->validated();
        $createBankAccountDTO = new CreateBankAccountDTO($payload['name'], $payload['start_balance'], auth()->id());
        $this->createBankAccount->execute($createBankAccountDTO);
        return back();
    }
}
