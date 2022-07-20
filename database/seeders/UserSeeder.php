<?php

namespace Database\Seeders;
use App\Models\User;
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
                ['phone' => '08158212666', 'email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active'],
                // ['phone' => '08087752375', 'email' => 'client@client.io', 'role' => 'client', 'password' => Hash::make('1234'), 'status' => 'active'],
            ];

            User::where('id', '>', 0)->delete();
            User::factory()->count(132)->create();
            foreach ($users as $user) {
                if (empty(User::where(['email' => $user['email']])->first())) {
                    User::create($user);
                } 
            }
        }
    }
}
