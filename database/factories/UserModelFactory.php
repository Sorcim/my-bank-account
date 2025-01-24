<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserModelFactory extends Factory
{

    protected $model = UserModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => 'johan@pesquer.fr',
            'password' => bcrypt('password'),
//            'id' => Str::uuid(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
