<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'user_name' => 'ammorsy',
            'email' => 'amr.mmorsy@gmail.com',
            "password" => Hash::make('123123'),
            'first_name' => 'amr',
            'last_name' => 'morsy',
        ]);
        $admin_role = Role::create(['name' => 'admin']);
        $perm_container = ['delete products', 'add products', 'edit products'];
        for ($i = 0; $i < count($perm_container); $i++) {
            Permission::create(['name' => $perm_container[$i]]);
        }
        $permissions = Permission::pluck('name');
            
        for ($i = 0; $i < count($permissions); $i++) {
            $admin_role->givePermissionTo($permissions[$i]);
        }
        $user->assignRole('admin');
    }
}
