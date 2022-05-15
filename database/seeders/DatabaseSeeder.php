<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User_Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        User_Address::factory(100)->create();
        // \App\Models\User::factory(10)->create();
    }
}
