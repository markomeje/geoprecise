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
            ['name' => 'Lifting or Extraction of Survey form', 'code' => 'LES', 'per' => 'Per Plot', 'amount' => 160000, 'description' => null, 'status' => 'active', 'category' => 'survey', 'payable' => true, 'reference' => Str::random(64)],

            ['name' => 'Change of title of Survey form', 'code' => 'CTS', 'per' => 'Per Plot', 'amount' => 160000, 'description' => null, 'status' => 'active', 'category' => 'survey', 'payable' => true, 'reference' => Str::random(64)],

            ['name' => 'Correction of name on Survey', 'code' => 'CNS', 'per' => 'Per Plot', 'amount' => 160000, 'description' => null, 'status' => 'active', 'category' => 'survey', 'payable' => true, 'reference' => Str::random(64)],

            ['name' => 'Site inspection or Beacon identification', 'code' => 'SIB', 'per' => 'Per Plot', 'amount' => 20000, 'description' => null, 'status' => 'active', 'category' => 'survey', 'payable' => true],

            ['name' => 'Property Search Request form', 'code' => 'PSR', 'per' => 'Per Lodgement', 'amount' => 5000, 'description' => null, 'status' => 'active', 'category' => 'search', 'payable' => true, 'reference' => Str::random(64)],

            ['name' => 'Plan Collection form', 'code' => 'PCO', 'per' => null, 'amount' => null, 'description' => null, 'status' => 'active', 'category' => 'plan', 'payable' => true, 'reference' => Str::random(64)],
        ];

        Form::truncate();
        foreach ($forms as $form) {
            Form::create($form);
        }
    }
}
