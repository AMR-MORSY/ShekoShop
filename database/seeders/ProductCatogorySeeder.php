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
        $options=array ('Cloth','Bags','Shoes','Electronics','Home');
        for ($i=0; $i<count($options);$i++)
        {
            $op=new Category();
            $op->category_name=$options[$i];
            $op->save();
        }
    }
}
