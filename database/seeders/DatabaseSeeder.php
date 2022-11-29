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
            ClientSeeder::class,
            FormSeeder::class,
            StaffSeeder::class,
            FeeSeeder::class,
            LayoutSeeder::class,
            PsrSeeder::class,
            PcfSeeder::class,
            SurveySeeder::class,
            RoleSeeder::class,
        ]);
    }
}
