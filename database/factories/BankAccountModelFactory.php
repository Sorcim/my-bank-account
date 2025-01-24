<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\BankAccountModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankAccountModelFactory extends Factory
{

    protected $model = BankAccountModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->userName(),
            'start_balance' => fake()->randomNumber(3),
        ];
    }
}
