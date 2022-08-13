<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'space_id' => Space::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'files' => [],
        ];
    }
}