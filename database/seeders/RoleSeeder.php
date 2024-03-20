<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm_container = ['Super-Admin', 'Admin'];
        for ($i = 0; $i < count($perm_container); $i++) {
            Role::create(['name' => $perm_container[$i]]);
        }
    }
}
