<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    

        // Create users
        $users = User::all(); // Create 50 users

        // Create 10 posts
        Post::factory()->count(40)->create()->each(function ($post) use ($users) {
            // Fetch a random subset of user IDs for comments and likes
            $commentsCount = rand(1, 50); // Random number between 1 and 10
            $likesCount = rand(1, 50);   // Random number between 1 and 20
            $randomUsersForComments = $users->random($commentsCount); // 5 unique users for comments
            $randomUsersForLikes = $users->random($likesCount);   // 10 unique users for likes

            // Create comments for the post with unique user IDs
            foreach ($randomUsersForComments as $user) {
                PostComment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }

            // Create likes for the post with unique user IDs
            foreach ($randomUsersForLikes as $user) {
                PostLike::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
