<?php

namespace Database\Factories;

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
        $lessons = array('Matematik','Edebiyat','Biyoloji','Fizik','Kimya','Tarih','Coğrafya');
        return [
            'lesson' => $lessons[rand(0, count($lessons) - 1)],
            'subject' => fake()->sentence,
            'content' => fake()->text,
            'deadline' => fake()->date,
            'photo' => fake()->imageUrl,
            'isDone' => fake()->boolean(),

        ];
    }
}
