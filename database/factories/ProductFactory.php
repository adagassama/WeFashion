<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        return [
            'name' => $this->faker ->sentence(),
            'description' => $this->faker -> paragraph(),
            //'price' => $this->faker -> randomDigit(),
            'price' => $this->faker -> numberBetween($min = 1, $max = 1000),
            'status' => $this->faker -> numberBetween($min = 1, $max = 2),
            'visibility' => $this->faker -> numberBetween($min = 1, $max = 2),
            'reference' => Str::random(16),
        ];
    }
}
