<?php

namespace Database\Seeders;
use App\Models\{Payment, Client};
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();
        Payment::factory()->count(Client::count() * 2)->create();
    }
}
