<?php

namespace Database\Factories;
use App\Models\{User, Role};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'created_by' => rand(1, 20),
            'user_id' => rand(User::count() - 7, User::count()),
            'address' => $this->faker->address(),
            'code' => strtoupper($this->faker->text($maxNbChars = 6)),
            'status' => $this->faker->randomElement(['inactive']),
            'role_id' => $this->faker->randomElement(Role::all()->pluck('id')->toArray()),
            'verified' => false,
        ];
    }
}
