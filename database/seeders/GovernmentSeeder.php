<?php

namespace Database\Seeders;

use App\Models\Government;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
