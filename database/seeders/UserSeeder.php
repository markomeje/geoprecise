<?php

namespace Database\Seeders;
use App\Models\{User, Client};
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment(['production'])) {}
    }
}





