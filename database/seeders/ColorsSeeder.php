<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $color_names = ['red', 'green', 'yellow', 'black','white','blue','brown','purple'];
        $color_codes=['#FF0000','#00FF00','#FFFF00','#000000','#FFFFFF','#0000FF','#964B00','#A020F0'];
        for($i=0;$i<count($color_names);$i++)
        {
            Color::create([
                'color_name' => $color_names[$i],
                'color_code'=>$color_codes[$i]
                
            ]);

        }
    }
}
