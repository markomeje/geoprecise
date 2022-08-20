<?php

namespace Database\Seeders;
use App\Models\{Fee, Form};
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fees = [
            ['name' => 'Property Search Fee', 'amount' => 5000, 'per' => 'Per Lodgement', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],
            
            ['name' => 'Additional Survey Print Plan', 'amount' => 10000, 'per' => 'Per Copy', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],

            ['name' => 'Re-establishement of Beacons', 'amount' => 10000, 'per' => 'Per Beacon', 'form_id' => null, 'additional' => null, 'active' => true],

            ['name' => 'Site Inspection or Beacon Identification', 'amount' => 20000, 'per' => 'Per Plot', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],

            ['name' => 'Legal fee for Land documentation by Our Company Lawyer', 'amount' => 50000, 'per' => 'Per Plot', 'form_id' => null, 'additional' => null, 'active' => true],

            ['name' => 'Lifting or Extraction of Survey', 'amount' => 160000, 'per' => 'Per Plot', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],
            ['name' => 'Change of Title of Survey', 'amount' => 160000, 'per' => 'Per Plot', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],

            ['name' => 'Correction of Name on Survey', 'amount' => 5000, 'per' => 'Per Copy', 'form_id' => rand(1, Form::count()), 'additional' => null, 'active' => true],
            ['name' => 'New Survey', 'amount' => 160000, 'per' => 'Per Plot', 'form_id' => null, 'additional' => null, 'active' => true],
            ['name' => 'Community Layout Survey Based on Professional NIS', 'amount' => null, 'per' => null, 'form_id' => null, 'additional' => 'Scale of Fees', 'active' => true],
        ];

        Fee::where('id', '>', 0)->delete();
        foreach ($fees as $fee) {
            Fee::create($fee);
        }
    }
}
