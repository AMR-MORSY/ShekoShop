<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Option;
use App\Models\Product;
use App\Models\Color;
use App\Models\User_Address;
use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // private function categories_seeder()
    // {
    // $options=array ('cloth','furniture','kitchen');
    // for ($i=0; $i<3;$i++)
    // {
    // $op=new Catogory();
    // $op-> category_name=$options[$i];
    // $op->save();
    // }
    // }
    //  private function option_group_seeder()
    //  {
    //  $options=array ('size','color','dimenssions');
    //  for ($i=0; $i<3;$i++)
    //  {
    //  $op=new OptionGroup();
    //  $op-> option_group_name=$options[$i];
    //  $op->save();

    //  }

    //  }

    private function colors_seeder()
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
    private function sizes_seeder()
    {
      
        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        foreach ($sizes as $size) {
            Size::create([
                'size_name' => $size,
                
            ]);
        }
    }
    public function run()
    {
        User::factory(100)->create();
        User_Address::factory(100)->create();
        // OptionGroup::factory(3)->create();
     
        $this->colors_seeder();
        $this->sizes_seeder();
        // Option::factory(20)->create();
        $this->call([
            ProductCatogorySeeder::class,
            AdminUserSeeder::class,
            ordinaryUserSeeder::class,

        ]);
        Product::factory(20)->create();
    }
}
