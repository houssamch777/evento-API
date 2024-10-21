<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => '1', // Assuming you have a User factory
            'name' => $this->faker->words(2, true), // Generate a random skill name (2 words)
            'experience' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Expert']), // Random experience level
            'offer_as_service' => $this->faker->boolean, // Random boolean value
            'portfolio_url' => $this->faker->optional()->url, // Generate a random URL, can be null
            'cost' => $this->faker->randomFloat(2, 1000, 30000), // Random cost between 10 and 1000, can be null
            'cost_type' => $this->faker->randomElement(['per_hour', 'per_task']), // Random cost type, can be null
            'availability' => $this->generateAvailability(), // Generate availability in the desired format

        ];
    }
    private function generateAvailability()
    {
        // Define the days of the week
        $days = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];

        // Create an array to hold the availability
        $availability = [];

        // Loop through the days and generate random availability times
        foreach ($days as $day) {
            // Randomly decide if this day should have availability
            if ($this->faker->boolean(70)) { // 70% chance to have availability
                $startTime = $this->faker->randomElement(['08:00', '09:00', '10:00', '06:30', '07:25']);
                $endTime = $this->faker->randomElement(['14:00', '17:00', '18:00','16:00']);
                $availability[$day] = "$startTime-$endTime";
            }
        }

        return $availability; // Convert the array to JSON
    }
}
