<?php

namespace Database\Seeders;

use App\Models\Devision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devisions = ["Men's Wear", "Women's Wear", "Children Wear", "Men's Bags", "Women's Bags", "Children Bags","Men's Shoes","Women's Shoes","Children Shoes",'Watches','Kitchen'];
        $categories=[1,1,1,2,2,2,3,3,3,4,5];
        for ($i=0;$i<count($devisions);$i++) {
            Devision::create([
                'devision_name' => $devisions[$i],
                'category_id'=>$categories[$i]
                
            ]);
        }
    }
}
