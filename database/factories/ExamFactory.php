<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exam_creater = array('Ahmet Hakan Cansız','Ahmet Karaaslanoğlu','Kubilay Karakaya','Yağmur Önder','Edanur Kaplan','İsa Eken');
        return [
            'deadline' => fake()->date,
            'exam_link' => fake() -> url,
            'sender' => $exam_creater[rand(0, count($exam_creater) - 1)],
        ];
    }
}
