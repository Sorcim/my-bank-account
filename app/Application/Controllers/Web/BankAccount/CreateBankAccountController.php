<?php

namespace App\Application\Controllers\Web\BankAccount;

use App\Application\Requests\BankAccount\CreateBankAccountRequest;
use App\Domain\Factories\BankAccountFactory;
use App\Domain\UseCases\BankAccount\CreateBankAccount;

class CreateBankAccountController
{
    public function __construct(private CreateBankAccount $createBankAccount) {}

    public function execute(CreateBankAccountRequest $request)
    {
        $payload = $request->validated();
        $this->createBankAccount->execute(BankAccountFactory::create($payload['name'], $payload['start_balance'], auth()->id()));

        return back();
    }
}
