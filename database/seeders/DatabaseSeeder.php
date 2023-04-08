<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassExam;
use App\Models\SchoolClassHomework;
use App\Models\Student;
use App\Models\Teacher;
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


        School::factory(3)->create()->each(function (School $school) {
            Teacher::factory(5)->create([
                'school_id' => $school->id,
            ]);
            SchoolClass::factory(5)->create([
                'school_id' => $school->id,
            ])->each(function (SchoolClass $schoolClass) {
                SchoolClassHomework::factory(10)->create(['school_class_id' => $schoolClass->id]);
                SchoolClassExam::factory()->create(['school_class_id' => $schoolClass->id]);
                Student::factory(5)->create([
                    'school_class_id' => $schoolClass->id,
                ]);
            });
        });
    }
}
