<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = WeightLog::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 90),
            'calories' => $this->faker->numberBetween(1200, 3500),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->words(3, true),
        ];
    }
}
