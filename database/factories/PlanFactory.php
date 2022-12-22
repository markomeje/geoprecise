<?php

namespace Database\Factories;
use App\Models\{Plan, Client, Layout};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plan_number' => rand(102, 1099),
            'client_name' => $this->faker->name(),
            'layout_id' => $this->faker->numberBetween($min = 1, $max = Layout::count()),
            'address' => $this->faker->address(),
        ];
    }

}
