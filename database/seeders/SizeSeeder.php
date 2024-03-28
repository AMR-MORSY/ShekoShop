<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm_container = ['250gm', '500gm', '1000gm'];
        for ($i = 0; $i < count($perm_container); $i++) {
            Size::create(['name' => $perm_container[$i]]);
        }
    }
}
