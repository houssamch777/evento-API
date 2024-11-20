<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'location' => $this->faker->city(),
            'job' => $this->faker->optional()->jobTitle(),
            'date_of_birth' => $this->faker->year(), // Between 18 and 60 years old
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'profile_picture' => $this->faker->optional()->imageUrl(200, 200, 'people', true, 'Profile'),
            'rating_average' => $this->faker->optional()->randomFloat(1, 0, 5), // Between 0 and 5
            'bio' => $this->faker->optional()->sentence(10),
            'social_links' => $this->faker->optional()->randomElement([
                json_encode([
                    'facebook' => $this->faker->url(),
                    'twitter' => $this->faker->url(),
                    'linkedin' => $this->faker->url(),
                ]),
            ]),
            'gender' => $this->faker->randomElement(['male', 'female']),

            'account_status' => $this->faker->randomElement(['active', 'suspended', 'deactivated']),
            'phone_verified_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),

            'created_at' => now(),
            'updated_at' => now(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
