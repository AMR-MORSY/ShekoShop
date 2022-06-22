<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Catogory;

use Illuminate\Database\Seeder;
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
            $op=new Category();
            $op->category_name=$options[$i];
            $op->save();
        }
    }
}
