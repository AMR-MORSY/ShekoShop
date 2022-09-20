<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\users_addresses>
 */
class User_AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>$this->faker->numberBetween(1,100),
            "address_line1" => $this->faker->address(),
           
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'mobile' => $this->faker->phoneNumber()


        ];
    }
}
