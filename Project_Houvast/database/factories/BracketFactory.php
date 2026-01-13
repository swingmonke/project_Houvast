<?php

namespace Database\Factories;

use App\Models\Bracket;
use Illuminate\Database\Eloquent\Factories\Factory;

class BracketFactory extends Factory
{
    protected $model = Bracket::class;

    public function definition(): array
    {
        return [
            'bracket_name' => 'Bracket ' . $this->faker->randomLetter,
            'weight_class'=> $this->faker->randomFloat(1, 40, 120),
            'location'    => $this->faker->bothify('B#'),
            'age'         => $this->faker->numberBetween(10, 40),
        ];
    }
}
