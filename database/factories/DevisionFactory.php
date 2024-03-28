<?php

namespace Database\Factories;

use App\Models\Devision;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DevisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */
    protected $model=Devision::class;
    public function definition(): array
    {
        $name=fake()->name();
        $slug=Str::slug($name,'-');
        return [
            "devision_name" => $name,
           "description" => fake()->text(300),
            "slug" => $slug,
          
            "images" => fake()->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg')
        ];
    }
}
