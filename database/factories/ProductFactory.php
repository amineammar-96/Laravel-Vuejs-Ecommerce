<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            "title" => $this->faker->name(),
            "coverState" => $this->faker->boolean(),
          //  "user_id" => User::all()->random()->id,
            "created_at" => now(),
            "updated_at"=>now(),
            "product_id" => $this->faker->numberBetween(1,10),
        ];
    }
}
