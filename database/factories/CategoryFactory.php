<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Devision;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Category::class;
    public function definition(): array
    {

        $name = fake()->name();
        $slug = Str::slug($name, '-');
        return [
            "category_name" => $name,
            "description" => fake()->text(300),
            "slug" => $slug,
            "devision_id"=>Devision::factory(),

          
        ];
    }
}
