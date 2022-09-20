<?php

namespace Database\Seeders;


use App\Models\Size;
use App\Models\User;
use App\Models\Color;
use App\Models\Option;
use App\Models\Product;
use App\Models\User_Address;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySizeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

   

    
    public function run()
    {
        User::factory(100)->create();
        // User_Address::factory(100)->create();
       
        $this->call([
            ProductCatogorySeeder::class,
            SizesSeeder::class,
            ColorsSeeder::class,
            AdminUserSeeder::class,
            ordinaryUserSeeder::class,
            DevisionsSeeder::class,
            TypesSeeder::class,
            CategorySizeSeeder::class,
            GovernmentSeeder::class,
            StateSeeder::class

        ]);
        // Product::factory(20)->create();
    }
}
