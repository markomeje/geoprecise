<?php

namespace Database\Seeders;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2017: 1-280
        // 2018: 1-153
        // 2019: 1-346
        // 2020: 1-454
        // 2021: 1-693
        // 2022: 1-522 
        Plan::truncate();
        $plans = [
            ['year' => 2017, 'min' => '1', 'max' => '280'],
            ['year' => 2018, 'min' => '1', 'max' => '153'],
            ['year' => 2019, 'min' => '1', 'max' => '346'],
            ['year' => 2020, 'min' => '1', 'max' => '454'],
            ['year' => 2021, 'min' => '1', 'max' => '693'],
            ['year' => 2022, 'min' => '1', 'max' => '522'],
        ];

        foreach ($plans as $plan) {
            for ($i = $plan['min']; $i <= $plan['max']; $i++) {
                $number = str_pad($i, 3, '0', STR_PAD_LEFT);
                Plan::create([
                    'plan_number' => $number,
                    'year' => $plan['year']
                ]);
            }
        }
    }
}
