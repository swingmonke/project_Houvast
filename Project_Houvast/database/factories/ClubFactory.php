<?php

namespace Database\Factories;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    protected $model = Club::class;

    public function definition(): array
    {
        return [
            'club_name' => $this->faker->company,
            'location'  => $this->faker->city,
            'country'   => $this->faker->country,
        ];
    }
}
