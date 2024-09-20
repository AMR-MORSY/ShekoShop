<?php

namespace Database\Seeders;

use App\Models\Government;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governs=['Alexandria','Cairo','Giza'];
        $shipping_rate=[150,75,75];
        for($i=0;$i<count($governs);$i++)
        {
            Government::create([
                'govern_name'=>$governs[$i],
                'shipping_rate'=>$shipping_rate[$i]
            ]);
        }
    }
}
