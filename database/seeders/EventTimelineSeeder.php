<?php

namespace Database\Seeders;

use App\Models\EventTimeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        EventTimeline::insert([
            [
                'event_id' => 1,
                'title' => 'Event Kickoff',
                'description' => 'Introduction and opening ceremony.',
                'start_time' => '2024-11-25 10:00:00',
                'end_time' => '2024-11-25 11:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'title' => 'Keynote Speech',
                'description' => 'Keynote address by the chief guest.',
                'start_time' => '2024-11-25 11:30:00',
                'end_time' => '2024-11-25 12:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'title' => 'Lunch Break',
                'description' => 'Networking and refreshments.',
                'start_time' => '2024-11-25 12:30:00',
                'end_time' => '2024-11-25 13:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'title' => 'Panel Discussion',
                'description' => 'Panel discussion on industry trends.',
                'start_time' => '2024-11-25 14:00:00',
                'end_time' => '2024-11-25 15:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'event_id' => 1,
                'title' => 'Closing Ceremony',
                'description' => 'Summary and thank-you speech.',
                'start_time' => '2024-11-25 16:00:00',
                'end_time' => '2024-11-25 17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
