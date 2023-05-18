<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Homework>
 */
class HomeworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => School::factory(),
            'user_id' => User::factory(),
            'subject' => fake()->sentence(),
            'photo' => fake()->imageUrl(),
            'content' => fake()->paragraph(),
            'link' => fake()->url,
            'deadline_at' => fake()->dateTimeBetween('now', '+1 month'),
            'completed_at' => fake()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
