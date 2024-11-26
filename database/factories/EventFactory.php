<?php

namespace Database\Factories;

use App\Models\EquipmentCategory;
use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\EventTimeline;
use App\Models\FurnitureCategory;
use App\Models\RoomCategory;
use App\Models\SkillName;
use App\Models\Event;
use App\Models\TransportationCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('+5 days', '+10 days'),
            'end_date' => $this->faker->dateTimeBetween('+11 days', '+15 days'),
            'fee' => $this->faker->boolean,
            'privacy' => $this->faker->boolean,
            'type' => $this->faker->randomElement(['In-person', 'Online']),
            'certificate' => $this->faker->boolean,
            'organizer_id' => User::all()->random()->id, // Assuming user ID 1 is the default organizer
        ];
    }
    public function withRelations()
    {
        return $this->afterCreating(function (Event $event) {
            // Attach random categories and domains
            $event->categories()->sync(
                EventCategory::all()->random(rand(1, 3))->pluck('id')->toArray()
            );
            $event->domains()->sync(
                EventDomain::all()->random(rand(1, 3))->pluck('id')->toArray()
            );

            // Attach asset needs
            $assetNeeds = [
                [
                    'assetable_id' => EquipmentCategory::all()->random()->id,
                    'assetable_type' => 'App\Models\EquipmentCategory',
                    'quantity' => rand(1, 5),
                    'notes' => $this->faker->sentence,
                ],
                [
                    'assetable_id' => FurnitureCategory::all()->random()->id,
                    'assetable_type' => 'App\Models\FurnitureCategory',
                    'quantity' => rand(10, 50),
                    'notes' => $this->faker->sentence,
                ],
                [
                    'assetable_id' => RoomCategory::all()->random()->id,
                    'assetable_type' => 'App\Models\RoomCategory',
                    'quantity' => 1,
                    'notes' => $this->faker->sentence,
                ],
            ];
            // Randomly generate asset needs
            $assetNeeds = [];

            // Generate random asset needs for Equipment Category (2 to 3 different assets)
            $numEquipmentNeeds = rand(0, 5); // Randomly decide how many Equipment Needs
            for ($i = 0; $i < $numEquipmentNeeds; $i++) {
                $assetNeeds[] = [
                    'assetable_id' => EquipmentCategory::all()->random()->id, // Random Equipment Category ID
                    'assetable_type' => 'App\Models\EquipmentCategory',
                    'quantity' => rand(1, 3), // Random quantity between 1 and 5
                    'notes' => $this->faker->sentence, // Random note
                ];
            }

            // Generate random asset needs for Furniture Category (1 to 2 different assets)
            $numFurnitureNeeds = rand(0, 5); // Randomly decide how many Furniture Needs
            for ($i = 0; $i < $numFurnitureNeeds; $i++) {
                $assetNeeds[] = [
                    'assetable_id' => FurnitureCategory::all()->random()->id, // Random Furniture Category ID
                    'assetable_type' => 'App\Models\FurnitureCategory',
                    'quantity' => rand(1, 200), // Random quantity between 1 and 5
                    'notes' => $this->faker->sentence, // Random note
                ];
            }
            // Generate random asset needs for Furniture Category (1 to 2 different assets)
            $numRoomNeeds = rand(0, 2); // Randomly decide how many Furniture Needs
            for ($i = 0; $i < $numRoomNeeds; $i++) {
                $assetNeeds[] = [
                    'assetable_id' => RoomCategory::all()->random()->id, // Random Furniture Category ID
                    'assetable_type' => 'App\Models\RoomCategory',
                    'quantity' => rand(1, 5), // Random quantity between 1 and 5
                    'notes' => $this->faker->sentence, // Random note
                ];
            }
            // Generate random asset needs for Furniture Category (1 to 2 different assets)
            $numTransportationNeeds = rand(0, 2); // Randomly decide how many Furniture Needs
            for ($i = 0; $i < $numTransportationNeeds; $i++) {
                $assetNeeds[] = [
                    'assetable_id' => TransportationCategory::all()->random()->id, // Random Furniture Category ID
                    'assetable_type' => 'App\Models\TransportationCategory',
                    'quantity' => rand(1, 5), // Random quantity between 1 and 5
                    'notes' => $this->faker->sentence, // Random note
                ];
            }

            foreach ($assetNeeds as $assetData) {
                $event->assetNeeds()->create($assetData);
            }

            // Attach skill needs
            $skills = SkillName::all()->random(rand(1, 3));
            foreach ($skills as $skill) {
                $event->skillNeeds()->create([
                    'skill_name_id' => $skill->id,
                    'quantity' => rand(1, 4),
                ]);
            }
            // Attach visual identity (logo, banner image)
            $event->visualIdentity()->create([
                'logo_url' => 'https://picsum.photos/400/400', // Random logo

                'banner_url' => 'https://picsum.photos/' . $this->faker->randomElement([800, 1024]) . '/' . $this->faker->randomElement([480, 600]), // Random banner
                
            ]);

            // Attach a timeline (milestones leading up to the event)
            $timelineData = [
                [
                    'title' => 'Event Planning Start',
                    'description' => 'Initial planning and organizing.',
                    'start_time' => $this->faker->dateTimeBetween($event->start_date, $event->end_date),
                ],
                [
                    'title' => 'Vendor Booking',
                    'description' => 'Confirming venue and vendor bookings.',
                    'start_time' => $this->faker->dateTimeBetween($event->start_date, $event->end_date),
                ],
                [
                    'title' => 'Final Setup',
                    'description' => 'Setup of the venue and final checks.',
                    'start_time' => $this->faker->dateTimeBetween($event->start_date, $event->end_date),
                ],
                [
                    'title' => 'Event Day',
                    'description' => 'The day the event is happening.',
                    'start_time' => $event->start_date,
                ],
                [
                    'title' => 'Post Event Wrap-up',
                    'description' => 'Wrapping up and evaluating the event.',
                    'start_time' => $event->end_date,
                ],
            ];

            foreach ($timelineData as $timelineItem) {
                $event->timeLine()->create($timelineItem);
            }
        });
    }
}
