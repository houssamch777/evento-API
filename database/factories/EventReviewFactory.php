<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventReview>
 */
class EventReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::inRandomOrder()->first()->id,  // Randomly select an event
            'user_id' => User::inRandomOrder()->first()->id,    // Randomly select a user
            'rating' => $this->faker->numberBetween(1, 5),      // Random rating between 1 and 5
            'comment' => $this->faker->paragraph(), // Random comment (optional)
        ];
    }
}
