<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
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
        return [
            'name' => $lessons[array_rand($lessons)],
        ];
    }
}
