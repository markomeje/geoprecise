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
            'form_id' => Form::where(['code' => 'LES'])->pluck('id')->toArray()[0],
            'purchaser_name' => $this->faker->name(),
            'purchaser_address' => $this->faker->address(),
            'purchaser_phone' => $this->faker->phoneNumber(),

            'seller_name' => $this->faker->name(),
            'seller_name' => $this->faker->address(),
            'seller_name' => $this->faker->phoneNumber(),

            'layout_id' => rand(1, Layout::count()),
            'client_id' => rand(1, Client::count()),

            'approval_comments' => $this->faker->text(),
            'approval_name' => $this->faker->name(),
            'approval_address' => $this->faker->address(),
            'status' => 'ongoing',

            'recorded_by' => rand(1, Staff::count()),
            'lifted_by' => rand(1, Staff::count()),
            'approved_by' => rand(1, Staff::count()),
        ];
    }
}
