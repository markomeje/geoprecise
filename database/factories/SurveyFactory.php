<?php

namespace Database\Factories;
use App\Models\{Client, Layout, Survey, Staff, Form};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'form_id' => $this->faker->randomElement(Form::where(['category' => 'surveys'])->pluck('id')->toArray()) ,
            'client_name' => $this->faker->name(),
            'client_address' => $this->faker->address(),
            'client_phone' => $this->faker->phoneNumber(),

            'seller_name' => $this->faker->name(),
            'seller_name' => $this->faker->address(),
            'seller_name' => $this->faker->phoneNumber(),

            'layout_id' => rand(1, Layout::count()),
            'client_id' => rand(1, Client::count()),
            'status' => 'ongoing',
        ];
    }
}
