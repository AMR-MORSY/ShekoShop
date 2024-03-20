<?php

namespace Database\Seeders;

use App\Models\Devision;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=["Espresso","Bundle","Turkish","Flavors","Instant coffee","Machines"];
        $description=["Best quality esspresso ever","best qualit Bundle ever","best quality Turkish coffee ever","best quality Flavors ever","best quality instant coffee ever","best qualities machines ever"];

        for($i=0;$i<count($categories);$i++)
        {
            Devision::create([
                "devision_name"=>$categories[$i],
                "description"=>$description[$i],
                "slug"=>Str::of($categories[$i])->slug('-')
            ]);


        }
    }
}
