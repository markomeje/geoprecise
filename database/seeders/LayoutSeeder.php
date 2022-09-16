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
        $layouts = ['Choice city layout', 'Peace layout', 'Christa City Layout'];

        Layout::truncate();
        foreach ($layouts as $layout) {
            Layout::create([
                'name' => $layout,
            ]);
        }
    }
}
