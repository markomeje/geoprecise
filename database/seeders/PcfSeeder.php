<?php

namespace Database\Seeders;
use App\Models\{Pcf, Client};
use Illuminate\Database\Seeder;

class PcfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pcf::truncate();
        Pcf::factory()->count(Client::count())->create();
    }
}
