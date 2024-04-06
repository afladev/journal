<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'url' => $this->faker->url,
            'thumbnail' => $this->faker->imageUrl,
            'author' => $this->faker->name,
            'description' => $this->faker->sentence(10),
            'published_at' => $this->faker->dateTimeBetween('2024-01-01'),
        ];
    }
}
