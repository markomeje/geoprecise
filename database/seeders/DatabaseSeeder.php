<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FormSeeder::class,
            FeeSeeder::class,
            ClientSeeder::class,
            LayoutSeeder::class,
            PlotSeeder::class,
            PsrSeeder::class,
        ]);
    }
}
