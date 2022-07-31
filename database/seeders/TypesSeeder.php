<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = array(
            'Bloomers', 'Blouse-Long Sleeves', 'Blouse-Short Sleeves', 'Blouse-Sleeveless', 'Bodysuit', 'Bra', 'Bustier', 'Caften',
            'Cardigan', 'Cloak', 'Coat', 'Corset', 'Dress', 'Dungarees', 'Jacket', 'Jeans', 'Jumper', 'Jumpsuit', 'Kilt', 'Kimono', 'Knickbockers', 'Leggings', 'Legwarmers',
            'Leotard', 'Panties', 'Pants', 'Petticoat', 'Playsuit', 'Poncho', 'Pyjamas', 'Sarong', 'Shawel', 'Shirt', 'Shorts', 'Skirt', 'Skort', 'Socks',
            'Sweater', 'Swimsuit', 'Teddy', 'Tie', 'Tights', 'Tops', 'Tracksuit', 'T-Shirt', 'Waistcoat'
        );
        foreach ($options as $option) {
            $op = new Type();
            $op->type_name = $option;
            $op->save();
        }
    }
}
