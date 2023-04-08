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
        $subjects = array('Matematik','Edebiyat','Biyoloji','Fizik','Kimya','Tarih','Coğrafya');
        return [
            'subject' => $subjects[rand(0, count($subjects) - 1)],
            'content' => fake()->text,
            'deadline' => fake()->date,
            'photo' => fake()->imageUrl,
        ];
    }
}
