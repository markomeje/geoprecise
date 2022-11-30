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
        User::truncate();
        $user = User::create([
            'phone' => '08063388846', 
            'email' => 'nnam.ug@gmail.com', 
            'role' => 'admin', 
            'password' => Hash::make('!ow-pre@360'), 
            'status' => 'active'
        ]);

    }
}





