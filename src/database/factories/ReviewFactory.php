<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => $this->faker->randomNumber(),
            'shop_id' => 1,
            'stars' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->country
        ];
    }
}
