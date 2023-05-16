<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numbers = range(1, 9);
        $alphabet = range('A', 'Z');
        $classNames = array_map(function ($number) use ($alphabet) {
            return $number . $alphabet[rand(0, count($alphabet) - 1)];
        }, $numbers);

        return [
            'school_id' => School::factory(),
            'name' => fake()->randomElement($classNames),
        ];
    }
}
