<?php

namespace Database\Seeders;

use App\Models\SkillName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Sample skill names to seed
        $skills = [
            // Technical skills
            ['name' => 'Web Developer', 'description' => 'Develops websites and web applications.', 'type' => 'Technical'],
            ['name' => 'Mobile App Developer', 'description' => 'Builds mobile applications for iOS and Android platforms.', 'type' => 'Technical'],
            ['name' => 'Database Administrator', 'description' => 'Manages and maintains databases.', 'type' => 'Technical'],
            ['name' => 'Network Engineer', 'description' => 'Designs, implements, and manages computer networks.', 'type' => 'Technical'],
            ['name' => 'System Administrator', 'description' => 'Maintains and configures IT systems.', 'type' => 'Technical'],
            ['name' => 'Cloud Engineer', 'description' => 'Works with cloud technologies like AWS, Azure, or Google Cloud.', 'type' => 'Technical'],
            ['name' => 'Security Analyst', 'description' => 'Protects systems and networks from cyber threats.', 'type' => 'Technical'],
            ['name' => 'Data Scientist', 'description' => 'Analyzes data and builds models for decision-making.', 'type' => 'Technical'],
            ['name' => 'AI Specialist', 'description' => 'Designs artificial intelligence algorithms and solutions.', 'type' => 'Technical'],
            ['name' => 'Software Engineer', 'description' => 'Designs and develops software applications.', 'type' => 'Technical'],

            // Management skills
            ['name' => 'Project Manager', 'description' => 'Oversees projects from initiation to completion.', 'type' => 'Management'],
            ['name' => 'Event Manager', 'description' => 'Plans and organizes events from start to finish.', 'type' => 'Management'],
            ['name' => 'Operations Manager', 'description' => 'Oversees the daily operations of the company or event.', 'type' => 'Management'],
            ['name' => 'Team Lead', 'description' => 'Leads a team to achieve project goals and deadlines.', 'type' => 'Management'],
            ['name' => 'Program Manager', 'description' => 'Manages and coordinates multiple projects simultaneously.', 'type' => 'Management'],
            ['name' => 'Product Manager', 'description' => 'Oversees product development and ensures timely delivery.', 'type' => 'Management'],
            ['name' => 'Logistics Manager', 'description' => 'Manages the transportation and storage of materials and equipment.', 'type' => 'Management'],
            ['name' => 'Operations Coordinator', 'description' => 'Coordinates various operational tasks within an organization or event.', 'type' => 'Management'],
            ['name' => 'Risk Manager', 'description' => 'Identifies and mitigates potential risks in projects or events.', 'type' => 'Management'],
            ['name' => 'Supply Chain Manager', 'description' => 'Manages the flow of goods and materials within an event or company.', 'type' => 'Management'],

            // Marketing skills
            ['name' => 'Marketing Specialist', 'description' => 'Plans and executes marketing campaigns.', 'type' => 'Marketing'],
            ['name' => 'Social Media Manager', 'description' => 'Manages social media accounts and content.', 'type' => 'Marketing'],
            ['name' => 'SEO Specialist', 'description' => 'Optimizes website content to rank higher on search engines.', 'type' => 'Marketing'],
            ['name' => 'Content Marketing Specialist', 'description' => 'Develops content strategies to drive audience engagement.', 'type' => 'Marketing'],
            ['name' => 'Email Marketing Specialist', 'description' => 'Manages and optimizes email marketing campaigns.', 'type' => 'Marketing'],
            ['name' => 'PPC Specialist', 'description' => 'Manages pay-per-click advertising campaigns on Google Ads and other platforms.', 'type' => 'Marketing'],
            ['name' => 'Brand Strategist', 'description' => 'Develops and manages brand strategies to boost recognition.', 'type' => 'Marketing'],
            ['name' => 'Public Relations Specialist', 'description' => 'Manages public image and media relations for events or companies.', 'type' => 'Marketing'],
            ['name' => 'Influencer Marketing Specialist', 'description' => 'Collaborates with influencers to promote events or brands.', 'type' => 'Marketing'],
            ['name' => 'Advertising Manager', 'description' => 'Plans and manages ad campaigns across multiple channels.', 'type' => 'Marketing'],

            // Creative skills
            ['name' => 'Graphic Designer', 'description' => 'Designs visual content for events, advertisements, and more.', 'type' => 'Creative'],
            ['name' => 'UI/UX Designer', 'description' => 'Designs user interfaces and ensures an optimal user experience.', 'type' => 'Creative'],
            ['name' => 'Video Editor', 'description' => 'Edits video content for promotional and event use.', 'type' => 'Creative'],
            ['name' => 'Photographer', 'description' => 'Captures photos during events or for promotional purposes.', 'type' => 'Creative'],
            ['name' => 'Motion Graphics Designer', 'description' => 'Creates animated visuals and graphics for digital content.', 'type' => 'Creative'],
            ['name' => 'Content Writer', 'description' => 'Writes articles, blogs, and promotional content for events.', 'type' => 'Creative'],
            ['name' => 'Event Designer', 'description' => 'Designs the overall look and feel of an event space.', 'type' => 'Creative'],
            ['name' => 'Copywriter', 'description' => 'Creates compelling written content for websites, ads, and events.', 'type' => 'Creative'],
            ['name' => 'Illustrator', 'description' => 'Creates illustrations for event marketing materials.', 'type' => 'Creative'],
            ['name' => 'Audio Engineer', 'description' => 'Manages the sound and audio aspects of events or media production.', 'type' => 'Creative'],

            // Event-Specific skills
            ['name' => 'Event Coordinator', 'description' => 'Coordinates logistics and details of events to ensure everything runs smoothly.', 'type' => 'Event'],
            ['name' => 'Stage Manager', 'description' => 'Manages the setup, execution, and breakdown of event stages.', 'type' => 'Event'],
            ['name' => 'Host/MC', 'description' => 'Leads and engages the audience during an event.', 'type' => 'Event'],
            ['name' => 'Ticketing Coordinator', 'description' => 'Manages the sales and distribution of event tickets.', 'type' => 'Event'],
            ['name' => 'Volunteer Coordinator', 'description' => 'Manages volunteers at an event and coordinates their duties.', 'type' => 'Event'],
            ['name' => 'Catering Manager', 'description' => 'Organizes and oversees catering services for events.', 'type' => 'Event'],
            ['name' => 'Security Personnel', 'description' => 'Ensures the safety and security of event attendees.', 'type' => 'Event'],
            ['name' => 'Event Logistics Coordinator', 'description' => 'Handles transportation, equipment, and materials for the event.', 'type' => 'Event'],
            ['name' => 'Audience Engagement Specialist', 'description' => 'Engages and interacts with the audience before, during, and after the event.', 'type' => 'Event'],
            ['name' => 'Sponsorship Manager', 'description' => 'Secures and manages sponsorships for events.', 'type' => 'Event'],

            // Miscellaneous skills
            ['name' => 'Legal Advisor', 'description' => 'Provides legal advice for contracts, rights, and liabilities in events.', 'type' => 'Miscellaneous'],
            ['name' => 'Financial Planner', 'description' => 'Manages the financial aspect of an event, including budgeting and expenses.', 'type' => 'Miscellaneous'],
            ['name' => 'Translator', 'description' => 'Translates content or materials for multilingual events.', 'type' => 'Miscellaneous'],
            ['name' => 'Compliance Officer', 'description' => 'Ensures events comply with relevant laws and regulations.', 'type' => 'Miscellaneous'],
            ['name' => 'Insurance Manager', 'description' => 'Handles the insurance needs of events to protect against liabilities.', 'type' => 'Miscellaneous'],
        ];
        // Insert the sample data
        foreach ($skills as $skill) {
            SkillName::create($skill);
        }

        // Success message
        $this->command->info('Skill names seeded successfully!');


    }
}
