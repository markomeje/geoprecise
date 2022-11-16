<?php

namespace Database\Factories;
use App\Models\{Client, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'dob' => $this->faker->date(),
            'title' => $this->faker->title(),
            'occupation' => $this->faker->jobTitle(),
            'address' => $this->faker->address(),
            'status' => 'incomplete',
            'user_id' => $this->faker->unique()->numberBetween($min = 1, $max = 500),
        ];
    }

}
