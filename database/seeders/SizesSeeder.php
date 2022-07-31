<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47'];
       
        for ($i=0;$i<count($sizes);$i++) {
            Size::create([
                'size_name' => $sizes[$i],
               
                
            ]);
        }
    }
}
