<?php

namespace Database\Factories;
use App\Models\{Client, Layout, Survey, Staff, Form};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pcf>
 */
class PcfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'survey_id' => rand(1, Survey::count()),
            'added_by' => rand(1, Staff::count()),
            'issued_by' => rand(1, Staff::count()),
            'form_id' => Form::where(['code' => 'PCF'])->pluck('id')->toArray()[0] ?? null,
            'plan_number' => rand(1, 45),
            'location' => $this->faker->address(),
            'plan_title' => $this->faker->name(),
            'client_id' => rand(1, Client::count()),
            'survey_id' => rand(1, Survey::count()),
            'status' => 'collected',
        ];
    }
}
