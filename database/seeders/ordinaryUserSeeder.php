<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ordinaryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'user_name' => 'hkawkab',
            'email' => 'heba.kawkab@gmail.com',
            "password" => Hash::make('123123'),
            'first_name' => 'heba',
            'last_name' => 'kawkab',
        ]);
    }
}
