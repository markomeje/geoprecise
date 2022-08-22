<?php

namespace Database\Factories;
use App\Models\{Layout, Plot, User, Form, Psr};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Psr>
 */
class PsrFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $plots = Plot::all()->pluck('number')->toArray();
        return [
            'plots' => $this->faker->randomElement($plots),
            'layout_id' => rand(1, Layout::count()),
            'form_id' => Form::where(['code' => 'PSR'])->pluck('id')->toArray()[0],
            'user_id' => rand(1, User::count() * 2),
            'status' => $this->faker->randomElement(Psr::STATUS),
            'completed' => false,
        ];
    }
}
