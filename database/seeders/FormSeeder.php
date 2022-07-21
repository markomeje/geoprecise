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
            ['name' => 'Application form for Lifting, Extraction or change of title of Survey Plan', 'code' => null, 'description' => null, 'status' => 'active'],
            ['name' => 'Plan collection form', 'code' => null, 'description' => null, 'status' => 'active'],
            ['name' => 'Site Inspection Booking form', 'code' => null, 'description' => null, 'status' => 'active'],
            ['name' => 'Client\'s Information System form', 'code' => 'CIS', 'description' => null, 'status' => 'active'],
            ['name' => 'Property Search Request form', 'code' => 'PSR', 'description' => null, 'status' => 'active'],
            ['name' => 'Plan Collection form', 'code' => null, 'description' => null, 'status' => 'active'],
        ];

        Form::where('id', '>', 0)->delete();
        foreach ($forms as $form) {
            Form::create($form);
        }
    }
}
