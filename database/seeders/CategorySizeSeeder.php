<?php

namespace Database\Seeders;

use App\Models\CategorySize;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $sizes = Size::all();
      
        for ($i = 0; $i < count($sizes); $i++) {

            if($sizes[$i]->id<=6 and $sizes[$i]->id>=1 )
            {
                CategorySize::create([
                    'size_id' => $sizes[$i]->id,
                    'category_id'=>1
    
    
                ]);

            }
            if($sizes[$i]->id>=7)
            {
                CategorySize::create([
                    'size_id' => $sizes[$i]->id,
                    'category_id'=>1
    
    
                ]);

            }
            if($sizes[$i]->id>=7)
            {
                CategorySize::create([
                    'size_id' => $sizes[$i]->id,
                    'category_id'=>3
    
    
                ]);

            }
        }
    }
}
