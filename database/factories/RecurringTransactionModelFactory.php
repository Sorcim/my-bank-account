<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\CategoryModel;
use App\Infrastructure\Persistence\RecurringTransaction;
use App\Infrastructure\Persistence\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RecurringTransactionModelFactory extends Factory
{
    protected $model = RecurringTransaction::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'startDate' => Carbon::now(),
            'endDate' => Carbon::now(),
            'frequency' => $this->faker->word(),
            'lastProcessedAt' => Carbon::now(),
            'nextProcessedAt' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'category_id' => CategoryModel::factory(),
            'user_id' => UserModel::factory(),
        ];
    }
}
