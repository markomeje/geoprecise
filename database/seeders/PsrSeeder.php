<?php

namespace Database\Seeders;
use App\Models\{Psr, User};
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
        Psr::factory()->count(User::count() * 10)->create();
    }
}
