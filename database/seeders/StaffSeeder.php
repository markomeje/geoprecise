<?php

namespace Database\Seeders;
use App\Models\{Staff, User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staff::truncate();
        Staff::factory()->count(7)->create();
    }
}
