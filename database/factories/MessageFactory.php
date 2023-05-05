<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userTypes = ['App\Models\User', 'App\Models\Teacher', 'App\Models\Student'];
        $sender = $this->faker->randomElement($userTypes)::factory()->create();

        return [
            'content' => $this->faker->realText(),
            'sender_id' => $sender->id,
        ];
    }
}
