<?php

namespace Database\Factories;

use App\Models\OptionGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'option_name'=>$this->faker->name(),
             
             'option_group_id'=>$this->faker->numberBetween($min = 1, $max = 3)
        ];
    }
}
