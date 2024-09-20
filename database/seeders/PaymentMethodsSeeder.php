<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perm_container = ['cash on delivery','visa','insatapay','VF cash','OEG cash','ET cash','WE cash'];
      
        for ($i = 0; $i < count($perm_container); $i++) {
            Payment::create([
                'name' => $perm_container[$i],
                
            ]);
        }
    }
}
