<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product_Catogory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCatogorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options=array ('cloth','furniture','kitchen');
        for ($i=0; $i<3;$i++)
        {
            $op=new Product_Catogory();
            $op->category_name=$options[$i];
            $op->save();
        }
    }
}
