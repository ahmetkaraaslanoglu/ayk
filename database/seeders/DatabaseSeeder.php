<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Role;
use App\Models\Absence;
use App\Models\ChatRoom;
use App\Models\ChatRoomMember;
use App\Models\ChatRoomMessage;
use App\Models\Exam;
use App\Models\Homework;
use App\Models\Lesson;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassExam;
use App\Models\SchoolClassHomework;
use App\Models\SchoolClassLesson;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Lesson::factory(100)->create();

        School::factory(15)->create()->each(function (School $school) {
            // create 5 User::class with teacher role
            User::factory(5)->create([
                'role' => Role::Teacher->value,
                'school_id' => $school->id,
            ]);

            // create 20 User::class with student role
            User::factory(20)->create([
                'role' => Role::Student->value,
                'school_id' => $school->id,
            ]);

            $studentIds = User::query()
                ->where('school_id', $school->id)
                ->where('role', Role::Student)
                ->get(['id'])
                ->pluck('id');

            $teacherIds = User::query()
                ->where('school_id', $school->id)
                ->where('role', Role::Teacher)
                ->get(['id'])
                ->pluck('id');

            // create 5 SchoolClass::class
            SchoolClass::factory(5)->create([
                'school_id' => $school->id,
            ])->each(function (SchoolClass $schoolClass) use ($studentIds, $teacherIds) {
                foreach ($studentIds as $studentId) {
                    $schoolClass->users()->attach($studentId, [
                        'role' => Role::Student->value,
                    ]);
                }

                foreach ($teacherIds as $teacherId) {
                    $schoolClass->users()->attach($teacherId, [
                        'role' => Role::Teacher->value,
                    ]);
                }

                Lesson::query()->inRandomOrder()->take(5)->each(function (Lesson $lesson) use ($schoolClass) {
                    SchoolClassLesson::factory()->create([
                        'school_class_id' => $schoolClass->id,
                        'lesson_id' => $lesson->id,
                    ]);
                });

                for ($i = 0; $i < rand(1, count($studentIds)); $i++) {
                    Absence::factory()->create([
                        'owner_id' => $teacherIds->random(),
                        'target_id' => $studentIds->random(),
                    ]);
                }
            });

            // create 5 homework
            Homework::factory(5)->create([
                'school_id' => $school->id,
                'user_id' => $teacherIds->random(),
            ])->each(function (Homework $homework) use ($school, $teacherIds) {
                // create 5 SchoolClassHomework::class
                SchoolClassHomework::factory(5)->create([
                    'school_class_id' => $school->id,
                    'homework_id' => $homework->id,
                ]);
            });

            // create 5 exams
            Exam::factory(5)->create([
                'school_id' => $school->id,
                'user_id' => $teacherIds->random(),
            ])->each(function (Exam $exam) use ($school, $teacherIds) {
                // create 5 SchoolClassExam::class
                SchoolClassExam::factory(5)->create([
                    'school_class_id' => $school->id,
                    'exam_id' => $exam->id,
                ]);
            });
        });

        Team::factory(2)->create()->each(function (Team $team) {
            $userIds = User::query()
                ->inRandomOrder()
                ->take(10)
                ->get(['id'])
                ->pluck('id');

            foreach ($userIds as $userId) {
                TeamMember::factory()->create([
                    'team_id' => $team->id,
                    'user_id' => $userId,
                ]);
            }

            ChatRoom::factory()->create([
                'team_id' => $team->id,
            ])->each(function (ChatRoom $chatRoom) use ($team) {
                $teamUserIds = TeamMember::query()
                    ->where('team_id', $team->id)
                    ->get(['user_id'])
                    ->pluck('user_id');

                foreach ($teamUserIds as $userId) {
                    ChatRoomMember::query()->create([
                        'chat_room_id' => $chatRoom->id,
                        'user_id' => $userId,
                    ])->each(function (ChatRoomMember $chatRoomMember) {
                        ChatRoomMessage::factory(5)->create([
                            'chat_room_id' => $chatRoomMember->chat_room_id,
                            'user_id' => $chatRoomMember->user_id,
                        ]);
                    });
                }
            });
        });

        $teachers = User::query()
            ->where('role', Role::Teacher)
            ->get(['id', 'name']);

        $students = User::query()
            ->where('role', Role::Student)
            ->get(['id', 'name']);

        foreach ($teachers as $teacher) {
            $student = $students->random();
            ChatRoom::factory()->create([
                'name' => $teacher->name . ', ' . $student->name,
                'team_id' => null,
            ])->each(function (ChatRoom $chatRoom) use ($teacher, $student) {
                ChatRoomMember::factory()->create([
                    'chat_room_id' => $chatRoom->id,
                    'user_id' => $teacher->id,
                ]);

                ChatRoomMember::factory()->create([
                    'chat_room_id' => $chatRoom->id,
                    'user_id' => $student->id,
                ]);

                for ($i = 0; $i < rand(1, 10); $i++) {
                    ChatRoomMessage::factory()->create([
                        'chat_room_id' => $chatRoom->id,
                        'user_id' => rand(0, 1) == 0 ? $teacher->id : $student->id,
                    ]);
                }
            });
        }

        foreach (Role::cases() as $role) {
            User::factory()->create([
                'role' => $role->value,
                'email' => $role->value . '@example.com',
                'name' => $role->value . ' User',
                'school_id' => null,
            ]);
        }
    }
}
