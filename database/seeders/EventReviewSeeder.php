<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get all events
        $events = Event::all();

        // For each event, create a random number of reviews (between 1 and 5)
        foreach ($events as $event) {
            // Random number of reviews per event (1 to 5)
            $reviewCount = rand(1, 100);

            // Create reviews for each event, ensuring no duplicate reviews for the same user
            for ($i = 0; $i < $reviewCount; $i++) {
                // Ensure a unique user is selected for each review
                $user = User::inRandomOrder()->first();

                // Check if this user already reviewed the event
                if (!EventReview::where('event_id', $event->id)->where('user_id', $user->id)->exists()) {
                    EventReview::factory()->create([
                        'event_id' => $event->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
