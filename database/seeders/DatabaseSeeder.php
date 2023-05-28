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
use App\Models\Post;
use App\Models\PostComment;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassExam;
use App\Models\SchoolClassHomework;
use App\Models\SchoolClassLesson;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\UserSchoolClass;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $lessons = [
            'Matematik',
            'Türkçe',
            'Tarih',
            'Coğrafya',
            'Felsefe',
            'Biyoloji',
            'Kimya',
            'Fizik',
            'Görsel Sanatlar',
            'Din Kültürü ve Ahlak Bilgisi',
            'İngilizce',
            'Almanca',
            'Fransızca',
        ];

        for ($i = 0; $i < count($lessons); $i++) {
            Lesson::factory()->create([
                'name' => $lessons[$i],
            ]);
        }

        School::factory()->create([
            'name' => 'Test School 1',
            'email' => 'ananınamı@example.com'
        ])->each(function ($school) use ($lessons) {

            for ($i = 0; $i<13 ; $i++){
                User::factory()->create([
                    'role' => Role::Teacher->value,
                    'school_id' => $school->id,
                    'lesson_id' => $i + 1,
                ]);
            }

            User::factory(10)->create([
                'role' => Role::Student->value,
                'school_id' => $school->id,
                'lesson_id' => null,
            ]);

            $var = rand(1,2);
            SchoolClass::factory(2)->create([
                'school_id' => $school->id,
                'name' => 'Test Class ' . $var,
            ]);

            for ($i = 0; $i<13; $i++){
                UserSchoolClass::factory()->create([
                    'school_class_id' => 1,
                    'user_id' => $i + 1,
                    'role' => Role::Teacher->value,
                ]);
            }

            for ($i = 13; $i<23; $i++){
                UserSchoolClass::factory()->create([
                    'school_class_id' => 1,
                    'user_id' => $i + 1,
                    'role' => Role::Student->value,
                ]);
            }

            for ($i = 0; $i<13; $i++){
                SchoolClassLesson::factory()->create([
                    'school_class_id' => 1,
                    'lesson_id' => $i+1,
                ]);
            }

            for ($i = 0; $i<13; $i++){
                Homework::factory()->create([
                    'school_id' => 1,
                    'user_id' => $i + 1,
                ]);
            }

            for ($i = 0; $i<13; $i++){
                SchoolClassHomework::factory()->create([
                    'school_class_id' => 1,
                    'homework_id' => $i + 1,
                ]);
            }

            for ($i = 0; $i<13; $i++){
                Exam::factory()->create([
                    'school_id' => 1,
                    'user_id' => $i + 1,
                ]);
            }

            for ($i = 0; $i<13; $i++){
                SchoolClassExam::factory()->create([
                    'school_class_id' => 1,
                    'exam_id' => $i + 1,
                ]);
            }

            for ($j = 0; $j<13; $j++){
                for ($i = 0; $i<10; $i++){
                    Absence::factory()->create([
                        'owner_id' => $j + 1,
                        'target_id' => $i + 1,
                    ]);
                }
            }

            for ($i = 0; $i<10; $i++){
                ChatRoom::factory()->create([
                    'team_id' => null,
                    'message_header' => 'Test Chat Room ' . $i+1,
                ]);
            }
            for ($i = 0; $i<10; $i++){
                ChatRoomMember::factory()->create([
                    'chat_room_id' => $i + 1,
                    'user_id' => $i + 1,
                ]);
                ChatRoomMember::factory()->create([
                    'chat_room_id' => $i + 1,
                    'user_id' => $i + 2,
                ]);
            }

            for ($i = 0; $i<10; $i++){
                ChatRoomMessage::factory()->create([
                    'chat_room_id' => $i + 1,
                    'user_id' => $i + 1,
                    'message' => 'Test Message ' . $i+1,
                ]);
                ChatRoomMessage::factory()->create([
                    'chat_room_id' => $i + 1,
                    'user_id' => $i + 2,
                    'message' => 'Test Message ' . $i+2,
                ]);

            }






        });
    }
}
