<?php

namespace IvanAquino\LaravelCredithub\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use IvanAquino\LaravelCredithub\Models\CreditTransaction;

class CreditTransactionFactory extends Factory
{
    protected $model = CreditTransaction::class;

    public function definition()
    {
        return [
            'creditable_type' => $this->faker->word,
            'creditable_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomFloat(2),
            'type' => $this->faker->randomElement(['credit', 'debit']),
            'payload' => [],
        ];
    }
}
