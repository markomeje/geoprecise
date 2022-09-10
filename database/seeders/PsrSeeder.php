<?php

namespace Database\Seeders;
use App\Models\{Psr, Client};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PsrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Psr::truncate();
        Psr::factory()->count(Client::count() * 10)->create();
    }
}
