<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentSchoolClassExam>
 */
class StudentSchoolClassExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'school_class_id' => SchoolClass::factory(),
            'exam_id' => Exam::factory(),
        ];
    }
}
