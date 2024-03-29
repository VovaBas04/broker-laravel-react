<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockUser>
 */
class StockUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'count'=>$this->faker->numberBetween(0,100),
            'wasted'=>$this->faker->randomFloat(2,0,1000)
        ];
    }
}
