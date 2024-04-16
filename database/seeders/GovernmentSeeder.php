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
        foreach($governs as $govern)
        {
            Government::create([
                'govern_name'=>$govern
            ]);
        }
    }
}
