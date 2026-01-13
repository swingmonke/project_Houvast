<?php

namespace Database\Factories;

use App\Models\TournamentYear;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentYearFactory extends Factory
{
    protected $model = TournamentYear::class;

    public function definition(): array
    {
        return [
            'tournament_year' => (string) $this->faker->numberBetween(2020, 2030),
        ];
    }
}