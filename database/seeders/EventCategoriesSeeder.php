<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //DB::table('event_categories')->truncate();
        // Seed event categories with descriptions
        $categories = [
            ['name' => 'Seminar', 'description' => 'A seminar is an event focused on education or professional development, usually featuring experts sharing knowledge on a specific topic.'],
            ['name' => 'Conference', 'description' => 'A conference typically brings together a large group of people to discuss a particular subject or industry. It may include multiple sessions, talks, and workshops.'],
            ['name' => 'Workshop', 'description' => 'A hands-on event designed to teach participants specific skills or techniques through practical exercises and activities.'],
            ['name' => 'Webinar', 'description' => 'An online seminar or presentation that allows participants to engage with the speaker remotely, typically with the ability to ask questions and participate in polls.'],
            ['name' => 'Hackathon', 'description' => 'An event where individuals or teams collaborate intensively over a set period to create software, hardware, or other technological solutions.'],
            ['name' => 'Exhibition', 'description' => 'An event where businesses, artists, or individuals showcase their products, services, or creative work to a broader audience.'],
            ['name' => 'Product Launch', 'description' => 'An event focused on introducing a new product to the market, often with demonstrations and promotions to generate excitement.'],
            ['name' => 'Meetup', 'description' => 'A casual gathering of individuals with common interests, usually for networking, sharing ideas, or socializing.'],
            ['name' => 'Networking Event', 'description' => 'An event designed for individuals to meet and build professional relationships, often involving ice-breaking activities or informal conversations.'],
            ['name' => 'Trade Show', 'description' => 'A large exhibition where companies showcase their products or services to potential buyers and partners, often focused on specific industries.'],
            ['name' => 'Symposium', 'description' => 'An academic or professional event where experts discuss a specific topic, often with presentations and scholarly papers shared among attendees.'],
            ['name' => 'Training Session', 'description' => 'An educational event focused on improving a specific skill set or knowledge in a professional or technical area.'],
            ['name' => 'Panel Discussion', 'description' => 'A form of debate or discussion where a group of experts shares their views on a specific topic, often followed by a Q&A session with the audience.'],
            ['name' => 'Cultural Event', 'description' => 'An event centered around the celebration of culture, such as art exhibitions, performances, music festivals, or food festivals.'],
            ['name' => 'Charity Event', 'description' => 'An event organized to raise money or awareness for a charitable cause, often involving donations, auctions, or fundraising activities.'],
            ['name' => 'Festival', 'description' => 'A celebratory event typically held annually, often featuring music, food, and entertainment, focused on a particular theme or community.'],
            ['name' => 'Product Demo', 'description' => 'An event designed to demonstrate the features and benefits of a product or service to potential customers or clients.'],
            ['name' => 'Awards Ceremony', 'description' => 'A formal event to recognize and honor achievements in a specific field, often with trophies, certificates, or other forms of recognition.'],
            ['name' => 'Concert', 'description' => 'A musical performance by artists or bands, usually in front of an audience, and often featuring live entertainment.'],
            ['name' => 'Sporting Event', 'description' => 'An event that involves competitive physical activities, such as a race, tournament, or match.'],
            ['name' => 'Virtual Conference', 'description' => 'A conference that takes place entirely online, allowing attendees to participate remotely and interact through digital platforms.'],
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            EventCategory::create($category);
        }

        // Print success message
        $this->command->info('Event categories seeded successfully!');
    }
}
