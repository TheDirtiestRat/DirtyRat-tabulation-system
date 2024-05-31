<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criteria>
 */
class CriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => fake()->numerify('0###'),
            'name' => fake()->jobTitle(),
            'points' => fake()->randomElement([
                '10',
                '20',
                '25',
                '30',
                '50',
                '60',
                '80',
                '95',
                '100'
            ]),
        ];
    }
}
