<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DevisionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            // PermissionSeeder::class,
            // RoleSeeder::class,
            // UserSuperAdminRoleSeeder::class,
            // DevisionSeeder::class
            OptionSeeder::class,
            SizeSeeder::class
        ]);
       
    }
}
