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
            ['role' => 'admin', 'phone' => '08158212666', 'email' => 'admin@admin.io', 'password' => Hash::make('1234!.')],
            ['role' => 'client', 'phone' => '08087752375', 'email' => 'user@user.io', 'password' => Hash::make('1234!.')],
        ];

        User::truncate();
        foreach ($users as $user) {
            $user = User::create($user);
            if ($user->role === 'client') {
                Client::create([
                    "user_id" => $user->id,
                    'fullname' => $faker->name(),
                    'dob' => $faker->date(),
                    'title' => $faker->title(),
                    'occupation' => $faker->jobTitle(),
                    'address' => $faker->address(),
                    'status' => 'incomplete',
                ]);
            }
        }

        if (app()->environment(['production'])) {
            User::create([
                'phone' => '08063388846', 
                'email' => 'nnam.ug@gmail.com', 
                'role' => 'admin', 
                'password' => Hash::make('!ow-pre@360'), 
                'status' => 'active'
            ]);
        }
    }
}





