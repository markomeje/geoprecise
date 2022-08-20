<?php

namespace Database\Seeders;
use App\Models\{User, Client};
use Illuminate\Database\Seeder;
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
        if(config('app.env') !== 'production') {
            $users = [
                ['phone' => '08158212666', 'email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active']
            ];

            User::where('id', '>', 0)->delete();
            foreach ($users as $user) {
                User::create($user);
            }

            User::factory()->count(67)->create();
        }
    }
}
