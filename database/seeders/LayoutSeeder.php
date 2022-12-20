<?php

namespace Database\Seeders;
use App\Models\{Layout, Plot};
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
            'Choice city Layout' => [
                ['category' => 'Residential Plots', 'max' => 1877, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial or residential Plots', 'max' => 55, 'prefix' => 'C/R'],
                ['category' => 'Commercial Plots', 'max' => 6, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Public Plots', 'max' => 14, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Space', 'max' => 4, 'min' => 1, 'prefix' => 'OS'],
            ],

            'Peace Layout' => [
                'address' => 'Ako Nike/Abgogazi Nike, Enugu East L.G.A Enugu State.',
                ['category' => 'Residential Plots', 'max' => 401, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial or Residential Plots', 'max' => 11, 'min' => 1, 'prefix' => 'C/R'],
                ['category' => 'Open Space', 'max' => 4, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Commercial Plots', 'max' => 2, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Public Plots', 'max' => 14, 'min' => 1, 'prefix' => 'UT'],
                ['category' => 'Utility Plots', 'max' => 14, 'min' => 1, 'prefix' => 'P'],
            ], 
            'Chrita City Layout' => [
                'address' => '  Umuanusa Aguagbaja. Umanan Ndiagu Eziagu L.G.A Enugu State.',
                ['category' => 'Residential Plots', 'max' => 945, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial Plots', 'max' => 2, 'min' => 1, 'prefix' => 'C'],

                ['category' => 'Primary School', 'max' => 2, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Place of Worship', 'max' => 4, 'min' => 3, 'prefix' => 'P'],
                ['category' => 'Security', 'max' => 5, 'min' => 5, 'prefix' => 'P'],
                ['category' => 'Health Center', 'max' => 6, 'min' => 6, 'prefix' => 'P'],
                ['category' => 'Refuse Dump', 'max' => 2, 'min' => 1, 'prefix' => 'RD'],
            ], 
            'Golden Gate Layout' => [
                'address' => '',
                ['category' => 'Residential Plots', 'max' => 1225, 'min' => 1, 'prefix' => ''],
                ['category' => 'Residential or Commercial Plots', 'max' => 62, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Shopping Center', 'max' => 1, 'min' => 1, 'prefix' => ''],
                ['category' => 'Church', 'max' => 1, 'min' => 1, 'prefix' => ''],
                ['category' => 'Nursery and Primary School', 'max' => 2, 'min' => 1, 'prefix' => ''],
                ['category' => 'Police Post', 'max' => 1, 'min' => 1, 'prefix' => ''],
                ['category' => 'Refuse Dump', 'max' => 4, 'min' => 1, 'prefix' => 'RD'],
                ['category' => 'Market', 'max' => 2, 'min' => 1, 'prefix' => ''],
                ['category' => 'Petrol Station', 'max' => 3, 'min' => 1, 'prefix' => 'UT'],
                ['category' => 'Play Ground', 'max' => 2, 'min' => 1, 'prefix' => 'UT'],
            ], 
            'Upright City' => [
                'address' => '',
                ['category' => 'Residential Plots', 'max' => 1538, 'min' => 1, 'prefix' => ''],
                ['category' => 'Public Plots', 'max' => 5, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial or Residential Plots', 'max' => 5, 'min' => 1, 'prefix' => ''],
                ['category' => 'Open Spaces', 'max' => 1, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Corner Shop', 'max' => 0, 'min' => 0, 'prefix' => ''],
            ], 
            'Victory Layout' => [
                'address' => 'Obinagu Amangwu Nike, Enugu East, L.G.A Enugu State',
                ['category' => 'Residential Plots', 'max' => 10138, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial or Residential Plots', 'max' => 530, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Commercial Plots', 'max' => 15, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Public Use Plots', 'max' => 15, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Spaces', 'max' => 17, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Corner Shops', 'max' => 17, 'min' => 1, 'prefix' => 'CS'],
            ], 
            'Monic Layout' => [
                'address' => 'Amakpaka Ugwogo Nike/Abgogazi Nike Enugu East L.G.A',
                ['category' => 'Residential Plots', 'max' => 1184, 'min' => 1, 'prefix' => ''],
                ['category' => 'Commercial or Residential Plots', 'max' => 24, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Commercial Plots', 'max' => 4, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Public Plots', 'max' => 10, 'min' => 1, 'prefix' => 'P'],

                ['category' => 'Public Plots', 'max' => 10, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Public Plots', 'max' => 10, 'min' => 1, 'prefix' => 'P'],
            ], 
            'Triumphant City Layout A' => [
                'address' => 'Abgogazi Enugu East Enugu State',
                ['category' => 'Residential Plots', 'max' => 833, 'min' => 1, 'prefix' => ''],
                ['category' => 'Residential or Commercial Plots', 'max' => 3, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Public Plots', 'max' => 8, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Spaces', 'max' => 4, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Refuse Disposal Dump', 'max' => 6, 'min' => 1, 'prefix' => 'RD'],
                ['category' => 'Police Post', 'max' => 1, 'min' => 1, 'prefix' => 'PP'],
            ], 
            'Triumphant City Layout B' => [
                'address' => '',
                ['category' => 'Residential Plots', 'max' => 774, 'min' => 1, 'prefix' => ''],
                ['category' => 'Residential or Commercial Plots', 'max' => 11, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Public Plots', 'max' => 11, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Spaces', 'max' => 2, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Commercial Plots', 'max' => 3, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Corner Shops', 'max' => 13, 'min' => 1, 'prefix' => 'CS'],
            ], 
            'Beloved Layout' => [
                'address' => '',
                ['category' => 'Residential Use Plots', 'max' => 1706, 'min' => 1, 'prefix' => ''],
                ['category' => 'Residential or Commercial Plots', 'max' => 248, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Commercial Plots', 'max' => 4, 'min' => 1, 'prefix' => 'C'],
                ['category' => 'Public Plots', 'max' => 10, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Spaces', 'max' => 4, 'min' => 1, 'prefix' => 'OS'],
                ['category' => 'Utility Plots', 'max' => 8, 'min' => 1, 'prefix' => 'CS'],
            ],
            'Bureacrat Layout Extension' => [
                'address' => '',
                ['category' => 'Residential Use Plots', 'max' => 197, 'min' => 1, 'prefix' => ''],
                ['category' => 'Residential or Commercial Plots', 'max' => 10, 'min' => 1, 'prefix' => 'CR'],
                ['category' => 'Special Plots', 'max' => 1, 'min' => 1, 'prefix' => 'S'],
                ['category' => 'Public Plots', 'max' => 1, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Open Spaces', 'max' => 1, 'min' => 1, 'prefix' => 'OS'],
            ], 
            'Trinity Layout' => [
                'address' => '',
                ['category' => 'Residential Plots', 'max' => 269, 'min' => 1, 'prefix' => '']
            ], 
            'City Of Lion Layout' => [
                'address' => '',
                ['category' => 'Residential Plots', 'max' => 347, 'min' => 1, 'prefix' => ''],
                ['category' => 'Public Plots', 'max' => 6, 'min' => 1, 'prefix' => 'P'],
                ['category' => 'Corner Shop', 'max' => 6, 'min' => 1, 'prefix' => 'CS'],
                ['category' => 'Open Spaces', 'max' => 2, 'min' => 1, 'prefix' => 'OS'],
            ],
            'Precious Estate Layout' => [
                'address' => 'Ogologoeji Ndiagu Akpugo, Nkanu West L.G.A, Enugu State',
            ], 
            'Golden Gate Layout' => [
                'address' => 'Umuani Okwor Ede, Agbogazi Nike, Enugu State',
            ], 
            'Ressurrection Layout' => [
                'address' => 'Nkwubor Nike, Enugu East L.G.A Enugu State',
            ], 
            'Akagu Owuinyi layout' => '', 
            'Agu Ibite layout' => '', 
            'Divine City layout' => '', 
            'Eastern homes estate layout' => '',
        ];

        Layout::truncate();
        Plot::truncate();
        foreach ($layouts as $layout => $details) {
            $layout = Layout::create([
                'name' => $layout,
                'address' => $details['address'] ?? '',
            ]);

            if(is_array($details)) {
                foreach($details as $key => $value) {
                    $max = $value['max'] ?? 0;
                    $min = $value['min'] ?? 0;
                    $max = $min == $max ? 1 : $max;
                    $prefix = !empty($value['prefix']) ? $value['prefix'] : '';
                    $category = $value['category'] ?? '';
                    if (!empty($max) && !empty($min)) {
                        for ($i = $min; $i <= $max; $i++) {
                            $number = empty($prefix) ? $i : (str_contains($prefix, '/') ? $prefix .''.$i : $prefix.'/'.$i);
                            Plot::create([
                                'number' => $number,
                                'name' => $category,
                                'category' => $category,
                                'layout_id' => $layout->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
