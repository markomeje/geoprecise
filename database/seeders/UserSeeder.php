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
        $faker = Faker::create();
        $users = [
            ['phone' => '08158212666', 'email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active'],
            ['phone' => '08158212661', 'email' => 'client@client.io', 'role' => 'client', 'password' => Hash::make('1234'), 'status' => 'active']
        ];

        User::truncate();
        User::factory()->count(67)->create();
        foreach ($users as $user) {
            User::create($user);
        }

    }
}
