<?php

namespace Database\Factories;
use App\Models\{Client, Staff};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => rand(15000, 250000),
            'model_id' => rand(1, 20),
            'model' => $this->faker->randomElement(['survey', 'psr', 'pcf', 'sibs']),
            'type' => $this->faker->randomElement(['card', 'pos', 'bank transfer', 'ussd']),
            'status' => 'paid',
            'recorder_type' => rand(1, Staff::count()),
            'client_id' => rand(1, Client::count()),
            'reference' => Str::uuid(),
            'verified' => false,
        ];
    }
}
