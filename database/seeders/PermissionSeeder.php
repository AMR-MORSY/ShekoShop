<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm_container = ['delete_product', 'store_product', 'view_product','update_product','delete_category', 'store_category', 'view_category','update_category','delete_devision', 'store_devision', 'view_devision','update_devision'];
        for ($i = 0; $i < count($perm_container); $i++) {
            Permission::create(['name' => $perm_container[$i]]);
        }
     
    }
}
