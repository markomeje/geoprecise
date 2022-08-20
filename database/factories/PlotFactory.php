<?php

namespace Database\Factories;
use App\Models\{Layout, Plot};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plot>
 */
class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomElement(['P1', 'C1', 'RD5', 'P6', 'C10']),
            'name' => $this->faker->name(),
            'layout_id' => rand(1, Layout::count()),
            'description' => '',
            'category' => $this->faker->randomElement(Plot::CATEGORIES),
        ];
    }
}
