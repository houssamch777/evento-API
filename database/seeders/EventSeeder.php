<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\EquipmentCategory;
use App\Models\EventSkillNeed;
use App\Models\FurnitureCategory;
use App\Models\RoomCategory;
use App\Models\Skill;
use App\Models\EventAssetNeed;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Fetch all categories, domains, equipment, furniture, room categories, and skills
        $categories = EventCategory::all();
        $domains = EventDomain::all();
        $equipmentCategories = EquipmentCategory::all();
        $furnitureCategories = FurnitureCategory::all();
        $roomCategories = RoomCategory::all();
        $skills = Skill::all();

        // Sample event data (with random categories, domains, asset needs, and skills)
        $events = [
            [
                'name' => 'Startup Pitch Event',
                'description' => 'A networking event for startups to pitch their ideas to investors.',
                'start_date' => now()->addDays(rand(5, 10)),
                'end_date' => now()->addDays(rand(10, 15)),
                'fee' => true,
                'privacy' => true,
                'type' => 'In-person',
                'certificate' => true,
                'categories' => $categories->random(1)->pluck('id')->toArray(),
                'domains' => $domains->random(1)->pluck('id')->toArray(),
                'asset_needs' => [
                    ['equipment_type_id' => $equipmentCategories->random(1)->pluck('id')->first(), 'quantity' => 3, 'notes' => 'Projectors for presentations'],
                    ['furniture_type_id' => $furnitureCategories->random(1)->pluck('id')->first(), 'quantity' => 50, 'notes' => 'Tables for attendees'],
                    ['room_type_id' => $roomCategories->random(1)->pluck('id')->first(), 'quantity' => 1, 'notes' => 'Conference room for pitching'],
                ],
                'skill_needs' => [
                    ['skill_name_id' => $skills->random(1)->pluck('id')->first(), 'quantity' => 2],
                    ['skill_name_id' => $skills->random(1)->pluck('id')->first(), 'quantity' => 1],
                ],
            ],
            [
                'name' => 'Tech Conference 2024',
                'description' => 'A conference for tech enthusiasts to explore new trends in AI and machine learning.',
                'start_date' => now()->addDays(rand(5, 10)),
                'end_date' => now()->addDays(rand(10, 15)),
                'fee' => true,
                'privacy' => true,
                'type' => 'In-person',
                'certificate' => true,
                'categories' => $categories->random(2)->pluck('id')->toArray(),
                'domains' => $domains->random(2)->pluck('id')->toArray(),
                'asset_needs' => [
                    ['equipment_type_id' => $equipmentCategories->random(1)->pluck('id')->first(), 'quantity' => 10, 'notes' => 'Microphones and speakers for each session'],
                    ['furniture_type_id' => $furnitureCategories->random(1)->pluck('id')->first(), 'quantity' => 50, 'notes' => 'Chairs for seating'],
                    ['room_type_id' => $roomCategories->random(1)->pluck('id')->first(), 'quantity' => 2, 'notes' => 'Conference rooms for workshops'],
                ],
                'skill_needs' => [
                    ['skill_name_id' => $skills->random(1)->pluck('id')->first(), 'quantity' => 5],
                    ['skill_name_id' => $skills->random(1)->pluck('id')->first(), 'quantity' => 3],
                ],
            ],
            // Add more events as needed
        ];

        // Create the events with the defined data
        foreach ($events as $eventData) {
            // Create the event
            $event = Event::create([
                'name' => $eventData['name'],
                'description' => $eventData['description'],
                'start_date' => $eventData['start_date'],
                'end_date' => $eventData['end_date'],
                'fee' => $eventData['fee'],
                'privacy' => $eventData['privacy'],
                'type' => $eventData['type'],
                'certificate' => $eventData['certificate'],
                'organizer_id' => 1, // Assuming user with ID 1 is the organizer
            ]);

            // Attach random categories and domains
            $event->categories()->sync($eventData['categories']);
            $event->domains()->sync($eventData['domains']);

            
            // Attach asset needs
            foreach ($eventData['asset_needs'] as $assetData) {
                $assetNeedData = [
                    'event_id' => $event->id,
                    'quantity' => $assetData['quantity'],
                    'notes' => $assetData['notes'],
                ];

                if (isset($assetData['equipment_type_id'])) {
                    $assetNeedData['assetable_id'] = $assetData['equipment_type_id'];
                    $assetNeedData['assetable_type'] = 'App\Models\EquipmentCategory';
                }

                if (isset($assetData['furniture_type_id'])) {
                    $assetNeedData['assetable_id'] = $assetData['furniture_type_id'];
                    $assetNeedData['assetable_type'] = 'App\Models\FurnitureCategory';
                }

                if (isset($assetData['room_type_id'])) {
                    $assetNeedData['assetable_id'] = $assetData['room_type_id'];
                    $assetNeedData['assetable_type'] = 'App\Models\RoomCategory';
                }

                EventAssetNeed::create($assetNeedData);
            }

            // Attach skill needs
            foreach ($eventData['skill_needs'] as $skillData) {
                EventSkillNeed::create([
                    'event_id' => $event->id,
                    'skill_name_id' => $skillData['skill_name_id'],
                    'quantity' => $skillData['quantity']
                ]);
            }
        }
    }
}

