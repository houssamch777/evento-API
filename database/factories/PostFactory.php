<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
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
            //
            'title' => $this->faker->sentence(6, true), // Generates a random sentence as a title
            'content' => $this->faker->paragraphs(3, true), // Generates multiple paragraphs as content
            'image_url' => 'https://picsum.photos/' . $this->faker->randomElement([640, 800, 1024]) . '/' . $this->faker->randomElement([480, 600, 768]),
            'user_id' => User::inRandomOrder()->first()->id, // Creates a user and associates it with the post
            'event_id' => $this->faker->boolean(50)
                ? Event::inRandomOrder()->first()->id
                : null, // Optional event association from existing events
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Random creation date
            'updated_at' => now(),
        ];
    }
}
