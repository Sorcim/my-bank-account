<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Persistence\TransactionModel;
use App\Infrastructure\Persistence\UserModel;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = UserModel::factory();
        $transaction = TransactionModel::factory(50);
        $bankAccount = BankAccountModel::factory()->for($user,'user')->create();
        $transaction->for($bankAccount, 'bankAccount')->create();
    }
}
