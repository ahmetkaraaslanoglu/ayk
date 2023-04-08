<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Homework;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolClassExam>
 */
class SchoolClassExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_class_id' => SchoolClass::factory(),
            'exam_id' => Exam::factory(),
        ];
    }
}
