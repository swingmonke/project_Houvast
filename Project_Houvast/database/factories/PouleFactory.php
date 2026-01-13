<?php

namespace Database\Factories;

use App\Models\Poule;
use Illuminate\Database\Eloquent\Factories\Factory;

class PouleFactory extends Factory
{
    protected $model = Poule::class;

    public function definition(): array
    {
        return [
            'poule_name'  => 'Poule ' . $this->faker->randomLetter,
            'weight_class'=> $this->faker->randomFloat(1, 40, 120),
            'location'    => $this->faker->bothify('A#'),
            'poule_size'  => $this->faker->numberBetween(4, 16),
            'age'         => $this->faker->numberBetween(10, 40),
        ];
    }
}

