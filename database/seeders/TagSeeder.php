<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Add a rich set of tags
        $tags = [
            'Technology',
            'Events',
            'Web Development',
            'Design',
            'Marketing',
            'Networking',
            'Leadership',
            'Conference',
            'Workshop',
            'Seminar',
            'Innovation',
            'Startups',
            'Business',
            'Artificial Intelligence',
            'Machine Learning',
            'Data Science',
            'Blockchain',
            'IoT',
            'Sustainability',
            'Health & Wellness',
            'Education',
            'Social Media',
            'Community',
            'Public Speaking',
            'Project Management',
            'Content Creation',
            'Entrepreneurship',
            'Creativity',
            'Teamwork',
        ];

        // Insert tags into the tags table
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }
    }
}
