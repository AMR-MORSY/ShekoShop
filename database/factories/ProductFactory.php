<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $maxNbChars = 250;
        $width = 640;
         $height = 480;
         $chanceOfGettingTrue = 3;
        return [
            'product_name'=>$this->faker->name(),
            'product_price'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8),
            'product_cartDesc'=>$this->faker->text($maxNbChars),
            'product_shortDesc'=>$this->faker->text($maxNbChars),
            'product_longDesc'=>$this->faker->text($maxNbChars),
            'category_id'=>$this->faker->numberBetween($min = 1, $max = 3),
            'devision_id'=>$this->faker->numberBetween($min = 1, $max = 9),
            'type_id'=>$this->faker->numberBetween($min = 1, $max = 44),
            'product_stock'=>$this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8),
            'product_live'=>$this->faker->boolean($chanceOfGettingTrue)



        ];
    }
}

// $table->string("product_SKU",50)->nullable();
// $table->string('product_name',100);
// $table->float('product_price');
// $table->float('product_weight')->nullable();
// $table->string('product_cartDesc',250);
// $table->string('product_shortDesc',1000);
// $table->text('product_longDesc');
// $table->string('product_thumb',100)->nullable();
// $table->string('product_img',100);
// $table->unsignedBigInteger('product_category_id');
// $table->foreign('product_category_id')->references('id')->on('product_catogories')->onDelete('ca
// $table->float('product_stock');
// $table->boolean('product_live')->default(0);