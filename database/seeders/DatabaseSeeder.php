<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\DevisionSeeder;
use Database\Seeders\GovernmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSuperAdminRoleSeeder::class,
            DevisionSeeder::class,
            OptionSeeder::class,
            SizeSeeder::class,
            GovernmentSeeder::class,
            StateSeeder::class,
            PaymentMethodsSeeder::class
        ]);
       
    }
}
