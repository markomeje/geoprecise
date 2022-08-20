<?php

namespace Database\Seeders;
use App\Models\Layout;
use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $layouts = [
            ['name' => 'Choice city layout'],
            ['name' => 'Peace layout'],
            ['name' => 'Christa City Layout'],
        ];

        Layout::where('id', '>', 0)->delete();
        foreach ($layouts as $layout) {
            Layout::create($layout);
        }
    }
}
