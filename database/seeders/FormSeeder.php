<?php

namespace Database\Seeders;
use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = [
            ['name' => 'New Survey', 'code' => 'NSV', 'per' => 'Per Plot', 'amount' => 160000, 'status' => 'active', 'category' => 'surveys', 'payable' => true],
            // ['name' => 'Additional Survey Print Plan - Reprinting', 'code' => 'APP', 'per' => 'Per Copy', 'amount' => 10000, 'status' => 'active', 'category' => 'surveys', 'payable' => true],
        ];

        foreach ($forms as $form) {
            Form::create($form);
        }
    }
}
