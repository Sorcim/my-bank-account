<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\BankAccountModel;
use App\Infrastructure\Persistence\TransactionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionModelFactory extends Factory
{

    protected $model = TransactionModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->userName(),
            'amount' => fake()->randomFloat(2, -10000, 10000),
            'effective_at' => fake()->dateTimeBetween('-2 months'),
        ];
    }
}
