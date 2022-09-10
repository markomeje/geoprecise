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
            ['name' => 'Lifting or Extraction of Survey form', 'code' => 'LES', 'per' => 'Per Plot', 'amount' => 160000, 'status' => 'active', 'category' => 'surveys', 'payable' => true],

            ['name' => 'Change of title of Survey form', 'code' => 'CTS', 'per' => 'Per Plot', 'amount' => 160000, 'status' => 'active', 'category' => 'surveys', 'payable' => true],

            ['name' => 'Correction of name on Survey', 'code' => 'CNS', 'per' => 'Per Plot', 'amount' => 160000, 'status' => 'active', 'category' => 'surveys', 'payable' => true],

            ['name' => 'Site inspection or Beacon identification', 'code' => 'SIB', 'per' => 'Per Plot', 'amount' => 20000, 'status' => 'active', 'category' => 'sibs', 'payable' => true],

            ['name' => 'Property Search Request form', 'code' => 'PSR', 'per' => 'Per Lodgement', 'amount' => 5000, 'status' => 'active', 'category' => 'psrs', 'payable' => true],

            ['name' => 'Plan Collection form', 'code' => 'PCF', 'per' => null, 'amount' => null, 'status' => 'active', 'category' => 'pcfs', 'payable' => true],
        ];

        Form::truncate();
        foreach ($forms as $form) {
            Form::create($form);
        }
    }
}
