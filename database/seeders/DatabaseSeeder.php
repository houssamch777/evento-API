<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentType;
use App\Models\Equipment;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Facility;
use App\Models\RoomFacility;
use App\Models\FurnitureType;
use App\Models\Furniture;
use App\Models\TransportationType;
use App\Models\Transportation;
use App\Models\Asset;
use App\Models\EquipmentRoom;
use App\Models\{
    Event,
    EventCategory,
    EventDomain,
    EventFee,
    EventAssetNeed,
    SkillName,
};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $skills = [
            // Communication Skills
            ['name' => 'Active Listening', 'type' => 'Communication Skills'],
            ['name' => 'Storytelling', 'type' => 'Communication Skills'],
            ['name' => 'Written Communication', 'type' => 'Communication Skills'],
            ['name' => 'Editing', 'type' => 'Communication Skills'],
            ['name' => 'Teaching', 'type' => 'Communication Skills'],
            ['name' => 'Negotiating', 'type' => 'Communication Skills'],
            ['name' => 'Open-mindedness', 'type' => 'Communication Skills'],
            ['name' => 'Inquiring', 'type' => 'Communication Skills'],
            ['name' => 'Body Language', 'type' => 'Communication Skills'],
            ['name' => 'Customer Service', 'type' => 'Communication Skills'],
            ['name' => 'Presenting', 'type' => 'Communication Skills'],
            ['name' => 'Summarizing', 'type' => 'Communication Skills'],
            ['name' => 'Nonverbal Communication', 'type' => 'Communication Skills'],
            ['name' => 'Documenting', 'type' => 'Communication Skills'],
            ['name' => 'Reporting', 'type' => 'Communication Skills'],

            // Interpersonal Skills
            ['name' => 'Patience', 'type' => 'Interpersonal Skills'],
            ['name' => 'Positivity', 'type' => 'Interpersonal Skills'],
            ['name' => 'Conflict Management', 'type' => 'Interpersonal Skills'],
            ['name' => 'Coaching', 'type' => 'Interpersonal Skills'],
            ['name' => 'Mediating', 'type' => 'Interpersonal Skills'],
            ['name' => 'Motivating', 'type' => 'Interpersonal Skills'],
            ['name' => 'Compassion', 'type' => 'Interpersonal Skills'],
            ['name' => 'Caring', 'type' => 'Interpersonal Skills'],
            ['name' => 'Networking', 'type' => 'Interpersonal Skills'],
            ['name' => 'Inspiring', 'type' => 'Interpersonal Skills'],
            ['name' => 'Flexibility', 'type' => 'Interpersonal Skills'],
            ['name' => 'Collaboration', 'type' => 'Interpersonal Skills'],
            ['name' => 'Sourcing Feedback', 'type' => 'Interpersonal Skills'],
            ['name' => 'Reliability', 'type' => 'Interpersonal Skills'],
            ['name' => 'Empathy', 'type' => 'Interpersonal Skills'],

            // Critical Thinking Skills
            ['name' => 'Observing', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Problem-solving', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Inferring', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Simplifying', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Conceptual Thinking', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Evaluating', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Streamlining', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Creative Thinking', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Brainstorming', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Cost-benefit Analyzing', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Deductive Reasoning', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Inductive Reasoning', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Assessing', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Evidence Collecting', 'type' => 'Critical Thinking Skills'],
            ['name' => 'Troubleshooting', 'type' => 'Critical Thinking Skills'],

            // Leadership Skills
            ['name' => 'Mentoring', 'type' => 'Leadership Skills'],
            ['name' => 'Envisioning', 'type' => 'Leadership Skills'],
            ['name' => 'Goal-setting', 'type' => 'Leadership Skills'],
            ['name' => 'Employee Development', 'type' => 'Leadership Skills'],
            ['name' => 'Performance Reviewing', 'type' => 'Leadership Skills'],
            ['name' => 'Managing', 'type' => 'Leadership Skills'],
            ['name' => 'Planning', 'type' => 'Leadership Skills'],
            ['name' => 'Delegating', 'type' => 'Leadership Skills'],
            ['name' => 'Directing', 'type' => 'Leadership Skills'],
            ['name' => 'Supervising', 'type' => 'Leadership Skills'],
            ['name' => 'Training', 'type' => 'Leadership Skills'],
            ['name' => 'Earning Trust', 'type' => 'Leadership Skills'],
            ['name' => 'Influencing', 'type' => 'Leadership Skills'],
            ['name' => 'Adapting', 'type' => 'Leadership Skills'],
            ['name' => 'Crisis Managing', 'type' => 'Leadership Skills'],

            // Technical Skills
            ['name' => 'Accounting', 'type' => 'Technical Skills'],
            ['name' => 'Word Processing', 'type' => 'Technical Skills'],
            ['name' => 'Spreadsheet Building', 'type' => 'Technical Skills'],
            ['name' => 'Coding', 'type' => 'Technical Skills'],
            ['name' => 'Programming', 'type' => 'Technical Skills'],
            ['name' => 'Operating Equipment', 'type' => 'Technical Skills'],
            ['name' => 'Engineering', 'type' => 'Technical Skills'],
            ['name' => 'Experimenting', 'type' => 'Technical Skills'],
            ['name' => 'Testing', 'type' => 'Technical Skills'],
            ['name' => 'Constructing', 'type' => 'Technical Skills'],
            ['name' => 'Restoring', 'type' => 'Technical Skills'],
            ['name' => 'Product Developing', 'type' => 'Technical Skills'],
            ['name' => 'Quality Controlling', 'type' => 'Technical Skills'],
            ['name' => 'Blueprint Drafting', 'type' => 'Technical Skills'],
            ['name' => 'Repairing', 'type' => 'Technical Skills'],

            // Language Skills
            ['name' => 'Translating', 'type' => 'Language Skills'],
            ['name' => 'Speaking', 'type' => 'Language Skills'],
            ['name' => 'Writing', 'type' => 'Language Skills'],
            ['name' => 'Conversing', 'type' => 'Language Skills'],
            ['name' => 'Reinterpreting', 'type' => 'Language Skills'],
            ['name' => 'Public Speaking', 'type' => 'Language Skills'],
            ['name' => 'Following Etiquette', 'type' => 'Language Skills'],
            ['name' => 'Explaining', 'type' => 'Language Skills'],
            ['name' => 'Respecting', 'type' => 'Language Skills'],
            ['name' => 'Signaling', 'type' => 'Language Skills'],
            ['name' => 'Proofreading', 'type' => 'Language Skills'],
            ['name' => 'Introducing', 'type' => 'Language Skills'],
            ['name' => 'Representing', 'type' => 'Language Skills'],
            ['name' => 'Rephrasing', 'type' => 'Language Skills'],
            ['name' => 'Code-switching', 'type' => 'Language Skills'],

            // Design Skills
            ['name' => 'Graphic Design', 'type' => 'Design Skills'],
            ['name' => 'User Experience Development', 'type' => 'Design Skills'],
            ['name' => 'User Interface Development', 'type' => 'Design Skills'],
            ['name' => 'Typography', 'type' => 'Design Skills'],
            ['name' => 'Layout Development', 'type' => 'Design Skills'],
            ['name' => 'Web Design', 'type' => 'Design Skills'],
            ['name' => 'Data Visualization', 'type' => 'Design Skills'],
            ['name' => 'Sketching', 'type' => 'Design Skills'],
            ['name' => 'Wireframing', 'type' => 'Design Skills'],
            ['name' => 'Branding', 'type' => 'Design Skills'],
            ['name' => 'Adobe Suite', 'type' => 'Design Skills'],
            ['name' => 'Illustration', 'type' => 'Design Skills'],
            ['name' => 'Animation', 'type' => 'Design Skills'],
            ['name' => '3D Modelling', 'type' => 'Design Skills'],
            ['name' => 'Video Editing', 'type' => 'Design Skills'],
        ];

        foreach ($skills as $skill) {
            SkillName::create($skill);
        }

        
    }
}
