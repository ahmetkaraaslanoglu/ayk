<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Absenteeism;
use App\Models\Message;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassExam;
use App\Models\SchoolClassHomework;
use App\Models\Student;
use App\Models\StudentSchoolClassExam;
use App\Models\Teacher;
use App\Models\TeacherSchoolClass;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Message::factory(10)->create();


        School::factory(3)->create()->each(function (School $school) {
            SchoolClass::factory(5)->create([
                'school_id' => $school->id,
            ])->each(function (SchoolClass $schoolClass) {
                Teacher::factory(5)->create([
                    'school_class_id' => $schoolClass->id,
                ])->each(function (Teacher $teacher){
                    TeacherSchoolClass::factory(5)->create([
                        'teacher_id' => $teacher->id,
                    ]);
                });
                SchoolClassHomework::factory(5)->create(['school_class_id' => $schoolClass->id]);
                SchoolClassExam::factory(5)->create(['school_class_id' => $schoolClass->id]);
                Student::factory(5)->create([
                    'school_class_id' => $schoolClass->id,
                ])->each(function (Student $student) {

                    Absenteeism::factory(5)->create([
                        'student_id' => $student->id,
                    ]);
                });
            });
        });
    }
}
