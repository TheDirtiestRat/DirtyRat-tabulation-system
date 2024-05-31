<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Judge>
 */
class JudgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judge_id' => fake()->numerify('0######'),
            'firstname' => fake()->firstName(),
            'middlename' => fake()->userName(),
            'lastname' => fake()->lastName(),
        ];
    }
}
