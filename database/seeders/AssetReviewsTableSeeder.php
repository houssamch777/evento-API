<?php

namespace Database\Seeders;

use App\Models\AssetReview;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('asset_reviews')->truncate(); // Optional: Clear existing reviews

        $reviews = [
            [
                'asset_id' => 19,
                'user_id' => 1, // Replace with a valid user_id from your database
                'rating' => 5,
                'comment' => 'The Canon EOS R5 camera is absolutely fantastic! The image quality is stunning, and it performed exceptionally well during my outdoor shoot. The asset owner was very professional and accommodating, ensuring everything was set up perfectly before the rental. Highly recommended!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 19,
                'user_id' => 2, // Replace with a valid user_id from your database
                'rating' => 4,
                'comment' => 'The Canon EOS R5 delivered great results during my event coverage. The autofocus is quick, and the 8K video capabilities are impressive. However, the asset owner was a bit late in delivering the equipment, which caused some delays. Overall, a good experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'asset_id' => 19,
                'user_id' => 3, // Replace with a valid user_id from your database
                'rating' => 3,
                'comment' => 'The Canon EOS R5 camera is decent but slightly overrated in my opinion. While the image stabilization is excellent, the battery life could be better. The asset owner seemed distracted and didn’t provide enough instructions for setup. It was okay, but not ideal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($reviews as $review) {
            AssetReview::create($review);
        }
    }
}
