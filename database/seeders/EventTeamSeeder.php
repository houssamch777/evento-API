<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $events = Event::all();
        foreach ($events as $event) {
            # code...
            $teamName = $event->name . ' Team'; // Team name is event name + "Team"
            $teamDescription = "This is the official team for the " . $event->name . ". Add members to help you make this event a success!";

            $team = Team::create([
                'event_id' => $event->id,
                'name' => $teamName,
                'description' => $teamDescription, // Default description
            ]);
            // Add the event organizer as a member of the team
            $team->members()->attach($event->organizer_id, [
                'role' => 'Admin',
            ]);
        }
    }
}
