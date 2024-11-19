<?php

namespace Database\Seeders;

use App\Models\EventDomain;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventDomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Define event domains to seed
        $domains = [
            ['name' => 'Technology', 'description' => 'Events related to technological advancements, innovation, and trends in the tech industry.'],
            ['name' => 'Business', 'description' => 'Events focused on business development, entrepreneurship, and corporate networking.'],
            ['name' => 'Education', 'description' => 'Events dedicated to learning, skill development, and academic discussions.'],
            ['name' => 'Health', 'description' => 'Events concerning health, wellness, medical advancements, and healthcare systems.'],
            ['name' => 'Entertainment', 'description' => 'Events related to movies, music, arts, and other entertainment forms.'],
            ['name' => 'Environment', 'description' => 'Events that discuss environmental issues, sustainability, and green initiatives.'],
            ['name' => 'Sports', 'description' => 'Events related to sports, physical activities, competitions, and games.'],
            ['name' => 'Food & Beverage', 'description' => 'Events focused on food, cooking, culinary arts, and the beverage industry.'],
            ['name' => 'Fashion', 'description' => 'Events highlighting fashion trends, design, runway shows, and the fashion industry.'],
            ['name' => 'Politics', 'description' => 'Events focused on political discussions, campaigns, elections, and governmental matters.'],
            ['name' => 'Travel & Tourism', 'description' => 'Events related to travel, tourism, destinations, and the hospitality industry.'],
            ['name' => 'Finance & Investment', 'description' => 'Events focusing on finance, investment opportunities, and economic trends.'],
            ['name' => 'Art & Culture', 'description' => 'Events that explore various art forms, cultural heritage, exhibitions, and performances.'],
            ['name' => 'Human Rights', 'description' => 'Events that promote and discuss human rights, advocacy, and social justice.'],
            ['name' => 'Science & Research', 'description' => 'Events focused on scientific research, advancements, and educational discussions in the science field.'],
            ['name' => 'Non-Profit & Charity', 'description' => 'Events related to philanthropy, charity work, and supporting causes for the greater good.'],
            ['name' => 'Real Estate', 'description' => 'Events dedicated to property development, sales, investments, and real estate trends.'],
            ['name' => 'Social Media & Marketing', 'description' => 'Events focusing on social media trends, digital marketing, and online branding strategies.'],
            ['name' => 'Gaming', 'description' => 'Events for gaming enthusiasts, e-sports competitions, and game development discussions.'],
            ['name' => 'Automotive', 'description' => 'Events related to cars, motorbikes, automotive design, and industry trends.'],
            ['name' => 'Architecture', 'description' => 'Events dedicated to architectural design, innovations in construction, and urban planning.'],
            ['name' => 'Law', 'description' => 'Events focusing on legal matters, law enforcement, and judicial discussions.'],
            ['name' => 'Philanthropy', 'description' => 'Events that focus on charitable actions, raising funds, and giving back to society.'],
            ['name' => 'Sustainability', 'description' => 'Events dedicated to promoting sustainability, eco-friendly initiatives, and green living.'],
            ['name' => 'Innovation', 'description' => 'Events that showcase cutting-edge innovations, startup companies, and creative solutions.'],
        ];

        // Insert domains into the event_domains table
        foreach ($domains as $domain) {
            EventDomain::create($domain);
        }
        // Success message
        $this->command->info('Event domains seeded successfully!');
    }
}
