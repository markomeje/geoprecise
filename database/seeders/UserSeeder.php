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
        User::truncate();
        if (app()->environment(['production'])) {
            User::create([
                'phone' => '08060545860', 
                'email' => 'hello@geoprecisegroup.com', 
                'role' => 'admin', 
                'password' => Hash::make('!ow-pre@360'), 
                'status' => 'active',
                'verified' => true
            ]);

            User::create([
                'phone' => '08158212666', 
                'email' => 'markomejeonline@gmail.com', 
                'role' => 'admin', 
                'password' => Hash::make('!tochukwu360@!.'), 
                'status' => 'active',
                'verified' => true
            ]);
        }
    }
}





