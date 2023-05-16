<?php

namespace Database\Factories;

use App\Enums\AbsenceReason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'target_id' => User::factory(),
            'reason' => fake()->randomElement(array_map(fn (AbsenceReason $reason) => $reason->value, AbsenceReason::cases())),
            'date' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
