<?php

namespace Database\Seeders;
use App\Models\{Role, Form};
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Manager',
            'Secretary',
            'Admin',
            'Surveyor',
        ];

        Role::truncate();
        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
