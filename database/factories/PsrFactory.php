<?php

namespace Database\Factories;
use App\Models\{Layout, Plot, Client, Form, Psr};
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
            'sold_by' => $this->faker->name(),
            'layout_id' => rand(1, Layout::count()),
            'form_id' => Form::where(['code' => 'PSR'])->pluck('id')->toArray()[0],
            'status' => $this->faker->randomElement(Psr::STATUS),
            'client_id' => rand(1, Client::count()),
            'completed' => false,
        ];
    }
}
