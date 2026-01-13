<?php

namespace Database\Factories;

use App\Models\Contestant;
use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestantFactory extends Factory
{
    protected $model = Contestant::class;

    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'infix'           => $this->faker->optional()->lastName,
            'weight'          => $this->faker->randomFloat(1, 40, 120),
            'date_of_birth'   => $this->faker->dateTimeBetween('-40 years', '-10 years')->format('Y-m-d'),
            'profile_picture' => null,
            'club_id'         => Club::factory(),
        ];
    }
}