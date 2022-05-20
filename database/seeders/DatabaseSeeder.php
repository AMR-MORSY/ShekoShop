<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Option;
use App\Models\Product;
use App\Models\OptionGroup;
use App\Models\User_Address;
use Illuminate\Database\Seeder;
use App\Models\Product_Catogory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private function categories_seeder()
    {
        $options=array ('cloth','furniture','kitchen');
        for ($i=0; $i<3;$i++)
        {
            $op=new Product_Catogory();
            $op-> category_name=$options[$i];
            $op->save();
        }
    }
     private function option_group_seeder()
     {
         $options=array ('size','color','dimenssions');
         for ($i=0; $i<3;$i++)
         {
             $op=new OptionGroup();
             $op-> option_group_name=$options[$i];
             $op->save();

         }

     }
    public function run()
    {
        User::factory(100)->create();
        User_Address::factory(100)->create();
        // OptionGroup::factory(3)->create();
        $this->option_group_seeder();
        Option::factory(20)->create();
        // $this->categories_seeder();
        $this->call([
            ProductCatogorySeeder::class
        ]);
        Product::factory(20)->create();
        // \App\Models\User::factory(10)->create();
    }
}
