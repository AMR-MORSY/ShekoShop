<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm_container = ['جوزة الطيب', "مستكة", 'حبهان'];
        $prices = ['10', '40', '10'];
        for ($i = 0; $i < count($perm_container); $i++) {
            Option::create([
                'name' => $perm_container[$i],
                "price" => $prices[$i]
            ]);
        }
    }
}
